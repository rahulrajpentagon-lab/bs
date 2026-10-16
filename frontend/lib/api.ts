// Browser calls go through Next rewrites (same-origin) so Sanctum cookies work.
const BROWSER_API_URL = '';

function getCookie(name: string): string | null {
  if (typeof document === 'undefined') return null;
  const match = document.cookie.match(new RegExp(`(?:^|; )${name}=([^;]*)`));
  return match ? decodeURIComponent(match[1]) : null;
}

export async function ensureCsrfCookie(): Promise<void> {
  await fetch(`${BROWSER_API_URL}/sanctum/csrf-cookie`, {
    method: 'GET',
    credentials: 'include',
  });
}

type ApiOptions = RequestInit & {
  json?: unknown;
  csrf?: boolean;
};

export async function api<T = unknown>(path: string, options: ApiOptions = {}): Promise<T> {
  const { json, csrf = false, headers, ...rest } = options;

  if (csrf) {
    await ensureCsrfCookie();
  }

  const xsrf = getCookie('XSRF-TOKEN');
  const response = await fetch(`${BROWSER_API_URL}${path}`, {
    credentials: 'include',
    headers: {
      Accept: 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      ...(json !== undefined ? { 'Content-Type': 'application/json' } : {}),
      ...(xsrf ? { 'X-XSRF-TOKEN': xsrf } : {}),
      ...headers,
    },
    body: json !== undefined ? JSON.stringify(json) : rest.body,
    ...rest,
  });

  const contentType = response.headers.get('content-type') || '';
  const isJson = contentType.includes('application/json');
  const payload = isJson ? await response.json() : null;

  if (!response.ok) {
    const error = new Error(
      (payload && (payload.message || payload.error)) || `Request failed (${response.status})`,
    ) as Error & { status?: number; errors?: Record<string, string[]>; payload?: unknown };
    error.status = response.status;
    error.errors = payload?.errors;
    error.payload = payload;
    throw error;
  }

  return payload as T;
}

export function assetUrl(path: string): string {
  if (!path) return '';
  if (path.startsWith('http')) return path;
  return `/${path.replace(/^\//, '')}`;
}

import type { Company, WorksResponse } from './types';

const API_URL = process.env.API_ORIGIN || process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000';

async function serverFetch<T>(path: string): Promise<T> {
  const response = await fetch(`${API_URL}${path}`, {
    headers: { Accept: 'application/json' },
    next: { revalidate: 60 },
  });

  if (!response.ok) {
    throw new Error(`Failed to fetch ${path}`);
  }

  return response.json() as Promise<T>;
}

export function getCompany(): Promise<Company> {
  return serverFetch<Company>('/api/company');
}

export function getWorks(): Promise<WorksResponse> {
  return serverFetch<WorksResponse>('/api/works');
}

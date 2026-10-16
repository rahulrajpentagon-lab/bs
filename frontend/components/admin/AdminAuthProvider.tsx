'use client';

import { createContext, useCallback, useContext, useEffect, useMemo, useState } from 'react';
import { usePathname, useRouter } from 'next/navigation';
import { api } from '@/lib/api';
import type { AdminUser } from '@/lib/types';

type AuthContextValue = {
  user: AdminUser | null;
  loading: boolean;
  refresh: () => Promise<void>;
  logout: () => Promise<void>;
};

const AuthContext = createContext<AuthContextValue | null>(null);

export function useAdminAuth() {
  const ctx = useContext(AuthContext);
  if (!ctx) {
    throw new Error('useAdminAuth must be used within AdminAuthProvider');
  }
  return ctx;
}

export default function AdminAuthProvider({ children }: { children: React.ReactNode }) {
  const [user, setUser] = useState<AdminUser | null>(null);
  const [loading, setLoading] = useState(true);
  const pathname = usePathname();
  const router = useRouter();
  const isLogin = pathname === '/admin/login';

  const refresh = useCallback(async () => {
    try {
      const data = await api<{ user: AdminUser }>('/api/admin/me');
      setUser(data.user);
    } catch {
      setUser(null);
      if (!isLogin) {
        router.replace('/admin/login');
      }
    } finally {
      setLoading(false);
    }
  }, [isLogin, router]);

  const logout = useCallback(async () => {
    try {
      await api('/api/admin/logout', { method: 'POST', csrf: true });
    } finally {
      setUser(null);
      router.replace('/admin/login');
    }
  }, [router]);

  useEffect(() => {
    void refresh();
  }, [refresh]);

  const value = useMemo(
    () => ({ user, loading, refresh, logout }),
    [user, loading, refresh, logout],
  );

  if (loading) {
    return (
      <div className="admin-login-page">
        <div className="admin-login-card text-center">Loading...</div>
      </div>
    );
  }

  if (!user && !isLogin) {
    return null;
  }

  return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

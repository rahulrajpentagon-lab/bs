import type { Metadata } from 'next';
import AdminAuthProvider from '@/components/admin/AdminAuthProvider';
import AdminShell from '@/components/admin/AdminShell';

export const metadata: Metadata = {
  title: 'Admin',
  robots: { index: false, follow: false },
};

export default function AdminLayout({ children }: { children: React.ReactNode }) {
  return (
    <>
      <link rel="stylesheet" href="/assets/css/admin.css" />
      <div className="admin-body">
        <AdminAuthProvider>
          <AdminShell>{children}</AdminShell>
        </AdminAuthProvider>
      </div>
    </>
  );
}

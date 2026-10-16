'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';
import { useAdminAuth } from './AdminAuthProvider';

export default function AdminShell({ children }: { children: React.ReactNode }) {
  const pathname = usePathname();
  const { user, logout } = useAdminAuth();

  if (pathname === '/admin/login') {
    return <>{children}</>;
  }

  const linkClass = (href: string) =>
    `admin-nav-link ${pathname === href || pathname.startsWith(`${href}/`) ? 'active' : ''}`;

  return (
    <div className="admin-wrapper">
      <aside className="admin-sidebar" id="adminSidebar">
        <div className="sidebar-brand">
          <Link href="/admin/dashboard" className="d-flex align-items-center gap-2 text-decoration-none">
            <img src="/assets/images/logo/kayacode-icon.svg" alt="Kayacode" width={32} height={32} />
            <span>Admin</span>
          </Link>
        </div>
        <nav className="admin-nav">
          <Link className={linkClass('/admin/dashboard')} href="/admin/dashboard">
            <i className="bi bi-speedometer2" /> Dashboard
          </Link>
          <Link className={linkClass('/admin/enquiries')} href="/admin/enquiries">
            <i className="bi bi-inbox" /> Enquiries
          </Link>
          <Link className={linkClass('/admin/notification-emails')} href="/admin/notification-emails">
            <i className="bi bi-envelope" /> Notification Emails
          </Link>
        </nav>
      </aside>

      <div className="admin-main">
        <header className="admin-topbar">
          <button
            type="button"
            className="btn btn-sm btn-outline-secondary d-lg-none"
            onClick={() => document.getElementById('adminSidebar')?.classList.toggle('open')}
          >
            Menu
          </button>
          <div className="ms-auto d-flex align-items-center gap-3">
            <span className="small text-muted">{user?.email}</span>
            <button type="button" className="btn btn-sm btn-outline-danger" onClick={() => void logout()}>
              Logout
            </button>
          </div>
        </header>
        <div className="admin-content">{children}</div>
      </div>
    </div>
  );
}

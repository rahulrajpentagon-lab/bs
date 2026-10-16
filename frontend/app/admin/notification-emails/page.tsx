'use client';

import { FormEvent, useEffect, useState } from 'react';
import { api } from '@/lib/api';
import type { NotificationEmail } from '@/lib/types';

export default function NotificationEmailsPage() {
  const [emails, setEmails] = useState<NotificationEmail[]>([]);
  const [message, setMessage] = useState<string | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [email, setEmail] = useState('');
  const [label, setLabel] = useState('');

  async function load() {
    const response = await api<{ data: NotificationEmail[] }>('/api/admin/notification-emails');
    setEmails(response.data);
  }

  useEffect(() => {
    load().catch((err: Error) => setError(err.message));
  }, []);

  async function onAdd(event: FormEvent) {
    event.preventDefault();
    setMessage(null);
    setError(null);
    try {
      const response = await api<{ message: string }>('/api/admin/notification-emails', {
        method: 'POST',
        csrf: true,
        json: { email, label },
      });
      setMessage(response.message);
      setEmail('');
      setLabel('');
      await load();
    } catch (err) {
      const e = err as Error & { errors?: Record<string, string[]> };
      setError(e.errors?.email?.[0] || e.message);
    }
  }

  async function toggleActive(item: NotificationEmail) {
    await api(`/api/admin/notification-emails/${item.id}`, {
      method: 'PUT',
      csrf: true,
      json: { label: item.label, is_active: !item.is_active },
    });
    await load();
  }

  async function remove(item: NotificationEmail) {
    if (!confirm(`Remove ${item.email}?`)) return;
    await api(`/api/admin/notification-emails/${item.id}`, { method: 'DELETE', csrf: true });
    await load();
  }

  return (
    <>
      <h1 className="h3 mb-4">Notification Emails</h1>

      {message && <div className="alert alert-success">{message}</div>}
      {error && <div className="alert alert-danger">{error}</div>}

      <div className="card mb-4">
        <div className="card-header">Add Email</div>
        <div className="card-body">
          <form className="row g-2" onSubmit={onAdd}>
            <div className="col-md-5">
              <input
                type="email"
                className="form-control"
                placeholder="email@example.com"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                required
              />
            </div>
            <div className="col-md-5">
              <input
                type="text"
                className="form-control"
                placeholder="Label (optional)"
                value={label}
                onChange={(e) => setLabel(e.target.value)}
              />
            </div>
            <div className="col-md-2">
              <button className="btn btn-primary w-100" type="submit">
                Add
              </button>
            </div>
          </form>
        </div>
      </div>

      <div className="card">
        <div className="table-responsive">
          <table className="table mb-0 align-middle">
            <thead>
              <tr>
                <th>Email</th>
                <th>Label</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {emails.map((item) => (
                <tr key={item.id}>
                  <td>{item.email}</td>
                  <td>{item.label || '—'}</td>
                  <td>
                    <span className={`badge ${item.is_active ? 'text-bg-success' : 'text-bg-secondary'}`}>
                      {item.is_active ? 'Active' : 'Inactive'}
                    </span>
                  </td>
                  <td className="text-end">
                    <button
                      type="button"
                      className="btn btn-sm btn-outline-secondary me-2"
                      onClick={() => void toggleActive(item)}
                    >
                      {item.is_active ? 'Disable' : 'Enable'}
                    </button>
                    <button
                      type="button"
                      className="btn btn-sm btn-outline-danger"
                      onClick={() => void remove(item)}
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))}
              {emails.length === 0 && (
                <tr>
                  <td colSpan={4} className="text-center text-muted py-4">
                    No notification emails configured.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </>
  );
}

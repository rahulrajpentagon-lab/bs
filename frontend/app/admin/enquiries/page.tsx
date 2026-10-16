'use client';

import { FormEvent, useEffect, useState } from 'react';
import Link from 'next/link';
import { useSearchParams, useRouter } from 'next/navigation';
import { api } from '@/lib/api';
import type { Enquiry } from '@/lib/types';

type ListResponse = {
  data: Enquiry[];
  meta: { current_page: number; last_page: number; total: number };
  filters: { search: string; status: string; from: string; to: string };
  statuses: Record<string, string>;
};

export default function AdminEnquiriesPage() {
  const searchParams = useSearchParams();
  const router = useRouter();
  const [payload, setPayload] = useState<ListResponse | null>(null);
  const [error, setError] = useState<string | null>(null);

  const query = searchParams.toString();

  useEffect(() => {
    api<ListResponse>(`/api/admin/enquiries${query ? `?${query}` : ''}`)
      .then(setPayload)
      .catch((err: Error) => setError(err.message));
  }, [query]);

  function onFilter(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    const form = new FormData(event.currentTarget);
    const params = new URLSearchParams();
    ['search', 'status', 'from', 'to'].forEach((key) => {
      const value = String(form.get(key) || '');
      if (value) params.set(key, value);
    });
    router.push(`/admin/enquiries?${params.toString()}`);
  }

  if (error) return <div className="alert alert-danger">{error}</div>;
  if (!payload) return <p>Loading enquiries...</p>;

  return (
    <>
      <h1 className="h3 mb-4">Enquiries</h1>

      <form className="row g-2 mb-4" onSubmit={onFilter}>
        <div className="col-md-4">
          <input
            name="search"
            className="form-control"
            placeholder="Name, email, phone, subject..."
            defaultValue={payload.filters.search}
          />
        </div>
        <div className="col-md-2">
          <select name="status" className="form-select" defaultValue={payload.filters.status}>
            <option value="">All statuses</option>
            {Object.entries(payload.statuses).map(([value, label]) => (
              <option key={value} value={value}>
                {label}
              </option>
            ))}
          </select>
        </div>
        <div className="col-md-2">
          <input type="date" name="from" className="form-control" defaultValue={payload.filters.from} />
        </div>
        <div className="col-md-2">
          <input type="date" name="to" className="form-control" defaultValue={payload.filters.to} />
        </div>
        <div className="col-md-2">
          <button className="btn btn-primary w-100" type="submit">
            Filter
          </button>
        </div>
      </form>

      <div className="card">
        <div className="table-responsive">
          <table className="table mb-0 align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Status</th>
                <th>Submitted</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {payload.data.map((enquiry) => (
                <tr key={enquiry.id}>
                  <td>#{enquiry.id}</td>
                  <td>{enquiry.name}</td>
                  <td>{enquiry.company || '—'}</td>
                  <td>{enquiry.email}</td>
                  <td>
                    <span className="badge text-bg-secondary">{enquiry.status_label}</span>
                  </td>
                  <td>{enquiry.created_at ? new Date(enquiry.created_at).toLocaleString() : '—'}</td>
                  <td>
                    <Link href={`/admin/enquiries/${enquiry.id}`}>View</Link>
                  </td>
                </tr>
              ))}
              {payload.data.length === 0 && (
                <tr>
                  <td colSpan={7} className="text-center text-muted py-4">
                    No enquiries found.
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      {payload.meta.last_page > 1 && (
        <div className="d-flex justify-content-between align-items-center mt-3">
          <span className="small text-muted">
            Page {payload.meta.current_page} of {payload.meta.last_page} ({payload.meta.total} total)
          </span>
          <div className="btn-group">
            <Link
              className={`btn btn-sm btn-outline-secondary ${payload.meta.current_page <= 1 ? 'disabled' : ''}`}
              href={`/admin/enquiries?${new URLSearchParams({
                ...Object.fromEntries(searchParams.entries()),
                page: String(payload.meta.current_page - 1),
              }).toString()}`}
            >
              Prev
            </Link>
            <Link
              className={`btn btn-sm btn-outline-secondary ${
                payload.meta.current_page >= payload.meta.last_page ? 'disabled' : ''
              }`}
              href={`/admin/enquiries?${new URLSearchParams({
                ...Object.fromEntries(searchParams.entries()),
                page: String(payload.meta.current_page + 1),
              }).toString()}`}
            >
              Next
            </Link>
          </div>
        </div>
      )}
    </>
  );
}

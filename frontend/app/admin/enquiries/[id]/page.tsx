'use client';

import { FormEvent, useEffect, useState } from 'react';
import Link from 'next/link';
import { useParams, useRouter } from 'next/navigation';
import { api } from '@/lib/api';
import type { Enquiry } from '@/lib/types';

type ShowResponse = {
  enquiry: Enquiry;
  statuses: Record<string, string>;
};

export default function AdminEnquiryShowPage() {
  const params = useParams<{ id: string }>();
  const router = useRouter();
  const [data, setData] = useState<ShowResponse | null>(null);
  const [status, setStatus] = useState('');
  const [notes, setNotes] = useState('');
  const [message, setMessage] = useState<string | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [saving, setSaving] = useState(false);

  useEffect(() => {
    api<ShowResponse>(`/api/admin/enquiries/${params.id}`)
      .then((response) => {
        setData(response);
        setStatus(response.enquiry.status);
        setNotes(response.enquiry.admin_notes || '');
      })
      .catch((err: Error) => setError(err.message));
  }, [params.id]);

  async function onSave(event: FormEvent) {
    event.preventDefault();
    setSaving(true);
    setMessage(null);
    setError(null);
    try {
      const response = await api<{ message: string; enquiry: Enquiry }>(
        `/api/admin/enquiries/${params.id}`,
        {
          method: 'PUT',
          csrf: true,
          json: { status, admin_notes: notes },
        },
      );
      setMessage(response.message);
      setData((prev) => (prev ? { ...prev, enquiry: response.enquiry } : prev));
    } catch (err) {
      setError((err as Error).message);
    } finally {
      setSaving(false);
    }
  }

  async function onDelete() {
    if (!confirm('Delete this enquiry?')) return;
    await api(`/api/admin/enquiries/${params.id}`, { method: 'DELETE', csrf: true });
    router.push('/admin/enquiries');
  }

  if (error && !data) return <div className="alert alert-danger">{error}</div>;
  if (!data) return <p>Loading enquiry...</p>;

  const enquiry = data.enquiry;

  return (
    <>
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h1 className="h3 mb-0">Enquiry #{enquiry.id}</h1>
        <Link href="/admin/enquiries" className="btn btn-outline-secondary btn-sm">
          Back
        </Link>
      </div>

      {message && <div className="alert alert-success">{message}</div>}
      {error && <div className="alert alert-danger">{error}</div>}

      <div className="row g-4">
        <div className="col-lg-7">
          <div className="card">
            <div className="card-body">
              <dl className="row mb-0">
                <dt className="col-sm-3">Name</dt>
                <dd className="col-sm-9">{enquiry.name}</dd>
                <dt className="col-sm-3">Email</dt>
                <dd className="col-sm-9">{enquiry.email}</dd>
                <dt className="col-sm-3">Phone</dt>
                <dd className="col-sm-9">{enquiry.phone || '—'}</dd>
                <dt className="col-sm-3">Company</dt>
                <dd className="col-sm-9">{enquiry.company || '—'}</dd>
                <dt className="col-sm-3">Service</dt>
                <dd className="col-sm-9">{enquiry.service || '—'}</dd>
                <dt className="col-sm-3">Subject</dt>
                <dd className="col-sm-9">{enquiry.subject || '—'}</dd>
                <dt className="col-sm-3">Message</dt>
                <dd className="col-sm-9" style={{ whiteSpace: 'pre-wrap' }}>
                  {enquiry.message}
                </dd>
              </dl>
            </div>
          </div>
        </div>

        <div className="col-lg-5">
          <div className="card">
            <div className="card-header">Update Status</div>
            <div className="card-body">
              <form onSubmit={onSave}>
                <div className="mb-3">
                  <label className="form-label" htmlFor="status">
                    Status
                  </label>
                  <select
                    id="status"
                    className="form-select"
                    value={status}
                    onChange={(e) => setStatus(e.target.value)}
                  >
                    {Object.entries(data.statuses).map(([value, label]) => (
                      <option key={value} value={value}>
                        {label}
                      </option>
                    ))}
                  </select>
                </div>
                <div className="mb-3">
                  <label className="form-label" htmlFor="notes">
                    Admin Notes
                  </label>
                  <textarea
                    id="notes"
                    className="form-control"
                    rows={5}
                    value={notes}
                    onChange={(e) => setNotes(e.target.value)}
                  />
                </div>
                <div className="d-flex gap-2">
                  <button className="btn btn-primary" type="submit" disabled={saving}>
                    {saving ? 'Saving...' : 'Save'}
                  </button>
                  <button className="btn btn-outline-danger" type="button" onClick={() => void onDelete()}>
                    Delete
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

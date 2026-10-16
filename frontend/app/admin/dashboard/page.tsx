'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';
import { api } from '@/lib/api';
import type { Enquiry } from '@/lib/types';

type DashboardData = {
  counts: Record<string, number>;
  recent_enquiries: Enquiry[];
};

export default function AdminDashboardPage() {
  const [data, setData] = useState<DashboardData | null>(null);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    api<DashboardData>('/api/admin/dashboard')
      .then(setData)
      .catch((err: Error) => setError(err.message));
  }, []);

  if (error) {
    return <div className="alert alert-danger">{error}</div>;
  }

  if (!data) {
    return <p>Loading dashboard...</p>;
  }

  const cards = [
    { label: 'Total', value: data.counts.total, icon: 'bi-inbox' },
    { label: 'New', value: data.counts.new, icon: 'bi-stars' },
    { label: 'Contacted', value: data.counts.contacted, icon: 'bi-telephone' },
    { label: 'In Progress', value: data.counts.in_progress, icon: 'bi-hourglass-split' },
    { label: 'Completed', value: data.counts.completed, icon: 'bi-check2-circle' },
  ];

  return (
    <>
      <div className="d-flex justify-content-between align-items-center mb-4">
        <h1 className="h3 mb-0">Dashboard</h1>
        <Link href="/admin/enquiries" className="btn btn-primary btn-sm">
          View Enquiries
        </Link>
      </div>

      <div className="row g-3 mb-4">
        {cards.map((card) => (
          <div className="col-6 col-lg" key={card.label}>
            <div className="card h-100">
              <div className="card-body">
                <div className="d-flex justify-content-between">
                  <span className="text-muted small">{card.label}</span>
                  <i className={`bi ${card.icon}`} />
                </div>
                <div className="fs-3 fw-bold">{card.value}</div>
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="card">
        <div className="card-header">Recent Enquiries</div>
        <div className="table-responsive">
          <table className="table mb-0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              {data.recent_enquiries.map((enquiry) => (
                <tr key={enquiry.id}>
                  <td>{enquiry.name}</td>
                  <td>{enquiry.email}</td>
                  <td>
                    <span className="badge text-bg-secondary">{enquiry.status_label}</span>
                  </td>
                  <td>
                    <Link href={`/admin/enquiries/${enquiry.id}`}>View</Link>
                  </td>
                </tr>
              ))}
              {data.recent_enquiries.length === 0 && (
                <tr>
                  <td colSpan={4} className="text-center text-muted py-4">
                    No enquiries yet.
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

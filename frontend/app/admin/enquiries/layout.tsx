import { Suspense } from 'react';

export default function EnquiriesLayout({ children }: { children: React.ReactNode }) {
  return <Suspense fallback={<p>Loading enquiries...</p>}>{children}</Suspense>;
}

import type { Metadata } from 'next';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import './globals.css';
import BootstrapClient from '@/components/BootstrapClient';

export const metadata: Metadata = {
  title: {
    default: 'Affordable Website Development Company in India | Kayacode',
    template: '%s | Kayacode',
  },
  description:
    'Kayacode is an affordable website development company in India offering professional websites, custom web applications, mobile apps and SEO.',
};

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en">
      <head>
        <link rel="stylesheet" href="/assets/css/app.min.css" />
        <link rel="icon" type="image/svg+xml" href="/assets/images/logo/kayacode-icon.svg" />
      </head>
      <body>
        <BootstrapClient />
        {children}
      </body>
    </html>
  );
}

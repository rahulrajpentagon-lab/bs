import type { Metadata } from 'next';
import ContactSection from '@/components/site/ContactSection';
import { getCompany } from '@/lib/server-api';

export const metadata: Metadata = {
  title: 'Request a Quote',
  description: 'Request a quote for affordable professional website development in India.',
};

export default async function RequestPage() {
  const company = await getCompany().catch(() => ({
    name: 'Kayacode',
    tagline: '',
    phone: '+91 90748 08592',
    email: 'hello@kayacode.com',
    whatsapp: '919074808592',
    location: 'Kerala, India',
  }));

  return (
    <>
      <section className="inner-banner">
        <div className="container">
          <h1>Request a Quote</h1>
          <p>Share your business goals and get a personal reply within one day.</p>
        </div>
      </section>

      <ContactSection company={company} />
    </>
  );
}

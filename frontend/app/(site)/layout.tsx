import Header from '@/components/site/Header';
import Footer from '@/components/site/Footer';
import { getCompany } from '@/lib/server-api';

export default async function SiteLayout({ children }: { children: React.ReactNode }) {
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
      <Header />
      <main>{children}</main>
      <Footer company={company} />
    </>
  );
}

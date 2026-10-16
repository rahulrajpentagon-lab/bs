import type { Metadata } from 'next';
import Link from 'next/link';

export const metadata: Metadata = {
  title: 'About',
  description: 'Learn about Kayacode — affordable professional website development in India.',
};

export default function AboutPage() {
  return (
    <>
      <section className="inner-banner">
        <div className="container">
          <h1>About Kayacode</h1>
          <p>Professional websites and digital solutions for Indian businesses.</p>
        </div>
      </section>

      <section className="section-padding">
        <div className="container">
          <div className="row align-items-center g-5">
            <div className="col-lg-6">
              <span className="section-label">WHO WE ARE</span>
              <h2 className="mt-3">Affordable website development with clear outcomes</h2>
              <p>
                Kayacode helps small businesses and startups launch professional websites, custom web
                applications and mobile apps — with clear communication and pricing tailored to your
                project.
              </p>
              <Link href="/request" className="btn-primary-custom mt-2">
                Tell Us About Your Project <i className="bi bi-arrow-right" />
              </Link>
            </div>
            <div className="col-lg-6">
              <img
                className="img-fluid rounded-4 shadow"
                src="/assets/images/hero/team-table.jpg"
                alt="Kayacode team collaborating on a business website project"
                width={900}
                height={500}
                loading="lazy"
                decoding="async"
              />
            </div>
          </div>
        </div>
      </section>

      <section className="why-section section-padding">
        <div className="container">
          <div className="section-title">
            <span className="section-label">WHY WORK WITH US</span>
            <h2>Professional websites at affordable prices</h2>
          </div>
          <div className="row g-4">
            {[
              ['Clear first reply', 'We respond within one day with price details based on what you share.'],
              ['Mobile-first builds', 'Every website and app is designed to work well on phones and desktops.'],
              ['Growth-ready setup', 'Start with a website and expand into systems, commerce or apps when needed.'],
            ].map(([title, text]) => (
              <div className="col-md-4" key={title}>
                <div className="stat-card h-100">
                  <strong>{title}</strong>
                  <span>{text}</span>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}

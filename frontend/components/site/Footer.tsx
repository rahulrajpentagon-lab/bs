'use client';

import Link from 'next/link';
import type { Company } from '@/lib/types';

type Props = {
  company: Company;
};

export default function Footer({ company }: Props) {
  return (
    <>
      <footer>
        <div className="container">
          <div className="row g-5">
            <div className="col-lg-4">
              <Link href="/" className="footer-brand">
                <img
                  src="/assets/images/logo/kayacode-logo-light.svg"
                  alt="kayacode"
                  className="brand-logo brand-logo-footer"
                  width={190}
                  height={44}
                  loading="lazy"
                  decoding="async"
                />
              </Link>
              <p className="mt-3">
                Affordable website development company in India offering professional websites,
                custom web applications, mobile apps and SEO for small businesses and startups
                across India.
              </p>
              <div className="social-links mt-4">
                <Link href="/" aria-label="Facebook">
                  <i className="bi bi-facebook" />
                </Link>
                <Link href="/" aria-label="Instagram">
                  <i className="bi bi-instagram" />
                </Link>
                <Link href="/" aria-label="LinkedIn">
                  <i className="bi bi-linkedin" />
                </Link>
                <Link href="/" aria-label="YouTube">
                  <i className="bi bi-youtube" />
                </Link>
              </div>
            </div>

            <div className="col-6 col-lg-2">
              <h5>Services</h5>
              <ul>
                <li>
                  <Link href="/services">Websites</Link>
                </li>
                <li>
                  <Link href="/services">Web Apps</Link>
                </li>
                <li>
                  <Link href="/services">Mobile Apps</Link>
                </li>
                <li>
                  <Link href="/services">SEO</Link>
                </li>
              </ul>
            </div>

            <div className="col-6 col-lg-2">
              <h5>Company</h5>
              <ul>
                <li>
                  <Link href="/">Home</Link>
                </li>
                <li>
                  <Link href="/request">Your Quote</Link>
                </li>
                <li>
                  <Link href="/works">Our Works</Link>
                </li>
                <li>
                  <Link href="/#process">Process</Link>
                </li>
                <li>
                  <Link href="/contact">Contact</Link>
                </li>
              </ul>
            </div>

            <div className="col-lg-4">
              <h5>Ready to Get Started?</h5>
              <p>Tell us about your business and receive a tailored quote within one day.</p>
              <Link href="/request" className="btn-primary-custom">
                Get a Free Quote
              </Link>
              <p className="mt-3 mb-0">
                <a href={`mailto:${company.email}`}>{company.email}</a>
                <br />
                <a href={`tel:${company.phone}`}>{company.phone}</a>
              </p>
            </div>
          </div>

          <div className="footer-bottom">
            <p>&copy; {new Date().getFullYear()} {company.name}. All rights reserved.</p>
          </div>
        </div>
      </footer>

      <a
        href={`https://wa.me/${company.whatsapp}`}
        target="_blank"
        rel="noopener noreferrer"
        className="whatsapp"
        aria-label="Contact us on WhatsApp"
      >
        <i className="bi bi-whatsapp" />
      </a>
    </>
  );
}

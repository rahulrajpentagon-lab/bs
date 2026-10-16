'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function Header() {
  const pathname = usePathname();

  const isActive = (href: string) => (pathname === href ? 'active' : '');

  return (
    <nav className="navbar navbar-expand-lg fixed-top">
      <div className="container">
        <Link className="navbar-brand" href="/">
          <img
            src="/assets/images/logo/kayacode-logo.svg"
            alt="kayacode"
            className="brand-logo"
            width={190}
            height={44}
            decoding="async"
          />
        </Link>

        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mainNav"
          aria-controls="mainNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon" />
        </button>

        <div className="collapse navbar-collapse" id="mainNav">
          <ul className="navbar-nav mx-auto">
            <li className="nav-item">
              <Link className={`nav-link ${isActive('/')}`} href="/">
                Home
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link ${isActive('/services')}`} href="/services">
                Services
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link ${isActive('/about')}`} href="/about">
                About
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link ${isActive('/works')}`} href="/works">
                Our Works
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" href="/#process">
                Process
              </Link>
            </li>
            <li className="nav-item">
              <Link className="nav-link" href="/#faq">
                FAQ
              </Link>
            </li>
            <li className="nav-item">
              <Link className={`nav-link ${isActive('/contact')}`} href="/contact">
                Contact
              </Link>
            </li>
          </ul>

          <Link href="/request" className="btn-primary-custom">
            Get a Free Quote
          </Link>
        </div>
      </div>
    </nav>
  );
}

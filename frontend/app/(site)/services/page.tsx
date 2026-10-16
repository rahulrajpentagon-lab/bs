import type { Metadata } from 'next';
import Link from 'next/link';

export const metadata: Metadata = {
  title: 'Services',
  description: 'Website development, web apps, mobile apps and SEO services from Kayacode.',
};

const services = [
  {
    icon: 'bi-globe2',
    title: 'Business Website',
    text: 'Affordable professional website development to establish your business online.',
    points: ['Responsive Design', 'Business Pages', 'Contact & WhatsApp', 'Basic SEO'],
  },
  {
    icon: 'bi-window-stack',
    title: 'Web Applications',
    text: 'Custom dashboards, portals and Laravel/PHP applications for real operations.',
    points: ['CRM & Admin Panels', 'Portals', 'Workflow Tools', 'Reports'],
  },
  {
    icon: 'bi-phone',
    title: 'Mobile Apps',
    text: 'Customer and business apps for booking, ordering, loyalty and notifications.',
    points: ['Android / Cross-platform', 'Booking & Delivery', 'Payments', 'Push Alerts'],
  },
  {
    icon: 'bi-graph-up-arrow',
    title: 'SEO',
    text: 'Improve search visibility, technical health and on-page structure.',
    points: ['Technical SEO', 'On-Page SEO', 'Keywords', 'Performance'],
  },
  {
    icon: 'bi-shield-check',
    title: 'Website Maintenance',
    text: 'Keep your website secure, updated and running smoothly.',
    points: ['Updates', 'Security', 'Bug Fixes', 'Support'],
  },
  {
    icon: 'bi-cart3',
    title: 'E-commerce',
    text: 'Sell products online with catalog, cart, checkout and order management.',
    points: ['Product Catalog', 'Checkout', 'Payments', 'Orders'],
  },
];

export default function ServicesPage() {
  return (
    <>
      <section className="inner-banner">
        <div className="container">
          <h1>Our Services</h1>
          <p>Practical digital solutions for websites, apps and growth.</p>
        </div>
      </section>

      <section className="services-section section-padding">
        <div className="container">
          <div className="row g-4">
            {services.map((service) => (
              <div className="col-md-6 col-xl-4" key={service.title}>
                <div className="service-card h-100">
                  <div className="service-icon" aria-hidden="true">
                    <i className={`bi ${service.icon}`} />
                  </div>
                  <h3>{service.title}</h3>
                  <p>{service.text}</p>
                  <ul>
                    {service.points.map((point) => (
                      <li key={point}>{point}</li>
                    ))}
                  </ul>
                  <Link href="/request" className="service-link">
                    Request a tailored quote
                  </Link>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </>
  );
}

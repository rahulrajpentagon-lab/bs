import Link from 'next/link';
import ContactSection from '@/components/site/ContactSection';
import WorksSlider from '@/components/site/WorksSlider';
import { getCompany, getWorks } from '@/lib/server-api';

export default async function HomePage() {
  const [company, works] = await Promise.all([
    getCompany().catch(() => ({
      name: 'Kayacode',
      tagline: '',
      phone: '+91 90748 08592',
      email: 'hello@kayacode.com',
      whatsapp: '919074808592',
      location: 'Kerala, India',
    })),
    getWorks().catch(() => ({ featured: [], all: [] })),
  ]);

  return (
    <>
      <section className="hero" id="home">
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6">
              <div className="hero-content">
                <div className="hero-badge">
                  <i className="bi bi-lightning-charge-fill" />
                  Affordable website development in India
                </div>
                <h1>
                  Digital solutions for your <span>next stage.</span>
                </h1>
                <p className="hero-description">
                  Kayacode is an affordable website development company in India offering
                  professional website development, premium websites at affordable prices, and
                  custom web applications for small businesses and startups across India.
                </p>
                <div className="hero-buttons">
                  <Link href="/request" className="btn-primary-custom">
                    Tell Us About Your Project <i className="bi bi-arrow-right" />
                  </Link>
                  <Link href="/#services" className="btn-outline-custom">
                    Explore Solutions
                  </Link>
                </div>
                <div className="hero-checks">
                  <span>
                    <i className="bi bi-check-circle-fill" /> Reply within one day
                  </span>
                  <span>
                    <i className="bi bi-check-circle-fill" /> Mobile Responsive
                  </span>
                  <span>
                    <i className="bi bi-check-circle-fill" /> SEO Ready
                  </span>
                </div>
              </div>
            </div>
            <div className="col-lg-6">
              <div className="hero-visual">
                <img
                  className="hero-photo"
                  src="/assets/images/hero/team-table.jpg"
                  alt="Business team sharing ideas around a table"
                  width={900}
                  height={500}
                  fetchPriority="high"
                  decoding="async"
                />
                <img
                  className="hero-photo-detail"
                  src="/assets/images/hero/team-plan.jpg"
                  alt="Small business team planning a project together"
                  width={480}
                  height={320}
                  loading="lazy"
                  decoding="async"
                />
                <div className="hero-photo-note">
                  <i className="bi bi-chat-square-heart-fill" />
                  Your goals first. A quote tailored to your project.
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section className="services-section section-padding" id="services">
        <div className="container">
          <div className="section-title">
            <span className="section-label">SERVICES</span>
            <h2>Affordable Website Development & Digital Solutions</h2>
            <p>
              Professional website development, custom web application development and
              cost-effective digital solutions for small businesses and startups across India.
            </p>
          </div>
          <div className="row g-4">
            {[
              {
                icon: 'bi-globe2',
                title: 'Business Website',
                text: 'Affordable professional website development to establish your business online with premium quality.',
                points: ['Responsive Design', 'Business Pages', 'Contact & WhatsApp', 'Basic SEO'],
              },
              {
                icon: 'bi-window-stack',
                title: 'Web Applications',
                text: 'Custom web application development for businesses that need more than a standard website.',
                points: ['Business Management Systems', 'Job Portals', 'Inventory & CRM', 'Dashboards'],
              },
              {
                icon: 'bi-phone',
                title: 'Mobile Apps',
                text: 'Mobile applications that connect customers with your business.',
                points: ['Customer & Business Apps', 'Booking & Delivery', 'Loyalty Apps', 'Payments'],
              },
              {
                icon: 'bi-graph-up-arrow',
                title: 'SEO',
                text: 'Improve your search visibility and attract relevant customers.',
                points: ['Technical SEO', 'On-Page SEO', 'Keyword Optimization', 'Performance'],
              },
            ].map((service) => (
              <div className="col-md-6 col-xl-3" key={service.title}>
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

      <WorksSlider works={works.featured} />

      <section className="process-section section-padding" id="process">
        <div className="container">
          <div className="section-title">
            <span className="section-label">PROCESS</span>
            <h2>From first conversation to launch.</h2>
            <p>A clear, collaborative workflow keeps the scope focused and your project moving forward.</p>
          </div>
          <div className="row g-4">
            {[
              ['Share the Brief', 'Tell us what you do, who you serve and what you want to improve.'],
              ['Plan the Experience', 'We map the pages, features and visual direction together.'],
              ['Build and Refine', 'We develop the solution and refine it with your feedback.'],
              ['Launch with Confidence', 'We test, launch and help you take the next step with confidence.'],
            ].map(([title, text], index) => (
              <div className="col-md-6 col-lg-3" key={title}>
                <div className="process-card h-100">
                  <span className="process-step">0{index + 1}</span>
                  <h4>{title}</h4>
                  <p>{text}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="cta-section">
        <div className="container text-center">
          <h2>Ready to Take Your Business Online?</h2>
          <p>Share your idea today. We will reply within one day with price details tailored to your project.</p>
          <Link href="/request" className="btn-primary-custom">
            Start My Website <i className="bi bi-arrow-right" />
          </Link>
        </div>
      </section>

      <section className="faq-section section-padding" id="faq">
        <div className="container">
          <div className="section-title">
            <span className="section-label">FAQ</span>
            <h2>Frequently Asked Questions</h2>
          </div>
          <div className="accordion" id="faqAccordion">
            {[
              ['How do I get price details?', 'Share your business details in the enquiry form. We reply within one day with clear pricing.'],
              ['Can you deliver my website within one week?', 'Many standard business websites can be delivered quickly once the brief and content are ready.'],
              ['Do you provide maintenance and renewal?', 'Yes. We can maintain, update and support your website after launch.'],
              ['Do you develop mobile applications?', 'Yes. We build customer and business mobile apps connected to your operations.'],
            ].map(([question, answer], index) => (
              <div className="accordion-item" key={question}>
                <h2 className="accordion-header">
                  <button
                    className={`accordion-button ${index === 0 ? '' : 'collapsed'}`}
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target={`#faq-${index}`}
                    aria-expanded={index === 0 ? 'true' : 'false'}
                  >
                    {question}
                  </button>
                </h2>
                <div
                  id={`faq-${index}`}
                  className={`accordion-collapse collapse ${index === 0 ? 'show' : ''}`}
                  data-bs-parent="#faqAccordion"
                >
                  <div className="accordion-body">{answer}</div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      <ContactSection company={company} />
    </>
  );
}

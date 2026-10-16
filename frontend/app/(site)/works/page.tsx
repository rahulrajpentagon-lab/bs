import type { Metadata } from 'next';
import Link from 'next/link';
import { getWorks } from '@/lib/server-api';

export const metadata: Metadata = {
  title: 'Our Works',
  description: 'Explore Kayacode websites, web apps and mobile app projects.',
};

export default async function WorksPage() {
  const works = await getWorks().catch(() => ({ featured: [], all: [] }));
  const websites = works.all.filter((item) => item.type === 'website' || item.type === 'webapp');
  const apps = works.all.filter((item) => item.type === 'mobile');

  return (
    <>
      <section className="inner-banner works-banner">
        <div className="container">
          <h1>Our Works</h1>
          <p>
            Explore websites, web applications and mobile apps designed for businesses across India —
            shown in simple laptop and phone previews.
          </p>
        </div>
      </section>

      <section className="works-page-section section-padding" id="websites">
        <div className="container">
          <div className="section-title">
            <span className="section-label">WEBSITES & WEB APPS</span>
            <h2>Website and web app projects</h2>
          </div>
          <div className="row g-4 g-xl-5">
            {websites.map((work) => (
              <div className="col-md-6" key={work.title}>
                <article className="work-device-card h-100">
                  <div className="device-laptop device-laptop-sm work-laptop">
                    <div className="device-laptop-screen">
                      <div className="device-laptop-camera" aria-hidden="true" />
                      <img
                        src={`/${work.image}`}
                        alt={`${work.title} website on laptop`}
                        className="device-screen-img"
                        width={1280}
                        height={720}
                        loading="lazy"
                        decoding="async"
                      />
                    </div>
                    <div className="device-laptop-base" aria-hidden="true">
                      <div className="device-laptop-notch" />
                    </div>
                  </div>
                  {work.mobile_image && (
                    <div className="device-phone device-phone-sm work-phone">
                      <div className="device-phone-notch" aria-hidden="true" />
                      <div className="device-phone-screen">
                        <img
                          src={`/${work.mobile_image}`}
                          alt={`${work.title} mobile website view`}
                          className="device-screen-img"
                          width={390}
                          height={844}
                          loading="lazy"
                          decoding="async"
                        />
                      </div>
                    </div>
                  )}
                  <div className="work-card-body">
                    <span className="works-category">{work.category}</span>
                    <h3>{work.title}</h3>
                    <p>{work.desc}</p>
                    <ul className="works-points">
                      {(work.features || []).map((feature) => (
                        <li key={feature}>
                          <i className="bi bi-check-circle-fill" /> {feature}
                        </li>
                      ))}
                    </ul>
                  </div>
                </article>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="mobile-apps-section section-padding" id="mobile-apps">
        <div className="container">
          <div className="section-title">
            <span className="section-label">MOBILE APPLICATIONS</span>
            <h2>App screens shown on mobile devices</h2>
          </div>
          <div className="row g-4 justify-content-center">
            {apps.map((app) => (
              <div className="col-sm-6 col-lg-4" key={app.title}>
                <article className="app-device-card h-100">
                  <div className="app-screen">
                    <img
                      src={`/${app.image}`}
                      alt={`${app.title} mobile application UI`}
                      className="app-screen-img img-fluid"
                      width={864}
                      height={1152}
                      loading="lazy"
                      decoding="async"
                    />
                  </div>
                  <div className="app-card-body text-center">
                    <span className="works-category">{app.category}</span>
                    <h3>{app.title}</h3>
                    <p>{app.desc}</p>
                  </div>
                </article>
              </div>
            ))}
          </div>
        </div>
      </section>

      <section className="cta-section">
        <div className="container text-center">
          <h2>Want a website or mobile app like these?</h2>
          <p>Tell us your idea and get a tailored quote within one day.</p>
          <Link href="/request" className="btn-primary-custom">
            Get a Free Quote <i className="bi bi-arrow-right" />
          </Link>
        </div>
      </section>
    </>
  );
}

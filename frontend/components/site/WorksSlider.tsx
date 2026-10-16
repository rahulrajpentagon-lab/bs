'use client';

import Link from 'next/link';
import type { WorkItem } from '@/lib/types';

type Props = {
  works: WorkItem[];
};

export default function WorksSlider({ works }: Props) {
  return (
    <section className="works-section section-padding" id="works">
      <div className="container">
        <div className="section-title">
          <span className="section-label">OUR WORKS</span>
          <h2>Projects that help businesses grow online</h2>
          <p>
            Websites, web apps and mobile applications crafted for startups and growing brands —
            designed to look premium and convert better.
          </p>
        </div>

        <div
          id="worksCarousel"
          className="carousel slide carousel-fade works-carousel"
          data-bs-ride="carousel"
          data-bs-interval="4500"
          data-bs-pause="hover"
          data-bs-touch="true"
          data-bs-wrap="true"
        >
          <div className="carousel-indicators works-indicators">
            {works.map((_, index) => (
              <button
                key={index}
                type="button"
                data-bs-target="#worksCarousel"
                data-bs-slide-to={index}
                className={index === 0 ? 'active' : ''}
                aria-current={index === 0 ? 'true' : 'false'}
                aria-label={`Slide ${index + 1}`}
              />
            ))}
          </div>

          <div className="carousel-inner">
            {works.map((work, index) => {
              const isMobile = work.type === 'mobile';
              return (
                <div key={work.title} className={`carousel-item ${index === 0 ? 'active' : ''}`}>
                  <div className="works-slide">
                    <div className="row align-items-center g-4 g-xl-5">
                      <div className="col-lg-7">
                        <div className="device-stage">
                          {isMobile ? (
                            <div className="device-phone">
                              <div className="device-phone-notch" aria-hidden="true" />
                              <div className="device-phone-screen">
                                <img
                                  src={`/${work.image}`}
                                  alt={`${work.title} mobile app design`}
                                  className="device-screen-img"
                                  width={864}
                                  height={1152}
                                  loading={index === 0 ? 'eager' : 'lazy'}
                                  decoding="async"
                                />
                              </div>
                            </div>
                          ) : (
                            <div className="device-laptop">
                              <div className="device-laptop-screen">
                                <div className="device-laptop-camera" aria-hidden="true" />
                                <img
                                  src={`/${work.image}`}
                                  alt={`${work.title} website design`}
                                  className="device-screen-img"
                                  width={1280}
                                  height={720}
                                  loading={index === 0 ? 'eager' : 'lazy'}
                                  decoding="async"
                                />
                              </div>
                              <div className="device-laptop-base" aria-hidden="true">
                                <div className="device-laptop-notch" />
                              </div>
                            </div>
                          )}
                        </div>
                      </div>
                      <div className="col-lg-5">
                        <div className="works-copy">
                          <span className="works-category">{work.category}</span>
                          <h3>{work.title}</h3>
                          <p>{work.desc}</p>
                          <ul className="works-points">
                            <li>
                              <i className="bi bi-check-circle-fill" /> Clean professional design
                            </li>
                            <li>
                              <i className="bi bi-check-circle-fill" /> Laptop & mobile friendly
                            </li>
                            <li>
                              <i className="bi bi-check-circle-fill" /> Built for business results
                            </li>
                          </ul>
                          <div className="d-flex flex-wrap gap-2 justify-content-lg-start justify-content-center">
                            <Link href="/request" className="btn-primary-custom">
                              Start a Similar Project <i className="bi bi-arrow-right" />
                            </Link>
                            <Link href="/works" className="btn-outline-custom">
                              View All Works
                            </Link>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>

          <button
            className="carousel-control-prev works-control"
            type="button"
            data-bs-target="#worksCarousel"
            data-bs-slide="prev"
            aria-label="Previous project"
          >
            <span className="works-control-btn">
              <i className="bi bi-chevron-left" />
            </span>
          </button>
          <button
            className="carousel-control-next works-control"
            type="button"
            data-bs-target="#worksCarousel"
            data-bs-slide="next"
            aria-label="Next project"
          >
            <span className="works-control-btn">
              <i className="bi bi-chevron-right" />
            </span>
          </button>
        </div>
      </div>
    </section>
  );
}

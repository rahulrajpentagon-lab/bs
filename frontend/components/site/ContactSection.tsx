import EnquiryForm from '@/components/site/EnquiryForm';
import type { Company } from '@/lib/types';

type Props = {
  company: Company;
  showBannerTitle?: boolean;
};

export default function ContactSection({ company }: Props) {
  return (
    <section className="contact-section section-padding" id="contact">
      <div className="container">
        <div className="section-title">
          <span className="section-label">START YOUR PROJECT</span>
          <h2>Tell Us About Your Business</h2>
          <p>
            Add your inquiry now. We will reply within one day with price details. Share your
            business details and ideas in the form below.
          </p>
        </div>

        <div className="contact-card">
          <div className="row g-4 g-lg-5 align-items-start">
            <div className="col-lg-5">
              <h3 className="contact-side-title">Let&apos;s Build Your Website.</h3>
              <p className="contact-side-text">
                The more you share about your business and ideas, the more useful our first reply
                will be.
              </p>

              <div className="contact-info">
                <i className="bi bi-envelope" aria-hidden="true" />
                <div>
                  <strong>Email</strong>
                  <br />
                  <a href={`mailto:${company.email}`}>{company.email}</a>
                </div>
              </div>

              <div className="contact-info">
                <i className="bi bi-telephone" aria-hidden="true" />
                <div>
                  <strong>Phone</strong>
                  <br />
                  <a href={`tel:${company.phone}`}>{company.phone}</a>
                </div>
              </div>

              <div className="contact-info">
                <i className="bi bi-whatsapp" aria-hidden="true" />
                <div>
                  <strong>WhatsApp</strong>
                  <br />
                  <a href={`https://wa.me/${company.whatsapp}`} target="_blank" rel="noopener noreferrer">
                    Chat with us
                  </a>
                </div>
              </div>

              <div className="contact-info">
                <i className="bi bi-geo-alt" aria-hidden="true" />
                <div>
                  <strong>Location</strong>
                  <br />
                  <span>{company.location}</span>
                </div>
              </div>
            </div>

            <div className="col-lg-7">
              <EnquiryForm />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

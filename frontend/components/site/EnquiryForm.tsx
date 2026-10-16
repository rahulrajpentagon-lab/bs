'use client';

import { FormEvent, useId, useState } from 'react';
import { api } from '@/lib/api';

type Props = {
  redirectAnchor?: string;
};

export default function EnquiryForm({ redirectAnchor = '#contact' }: Props) {
  const uid = useId();
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = useState<string | null>(null);
  const [errors, setErrors] = useState<Record<string, string[]>>({});
  const [message, setMessage] = useState<string | null>(null);

  async function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setLoading(true);
    setErrors({});
    setMessage(null);
    setSuccess(null);

    const form = event.currentTarget;
    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    try {
      const response = await api<{ message: string }>('/api/enquiries', {
        method: 'POST',
        json: payload,
        csrf: true,
      });
      setSuccess(response.message);
      form.reset();
      if (redirectAnchor) {
        window.location.hash = redirectAnchor.replace('#', '');
      }
    } catch (error) {
      const err = error as Error & { errors?: Record<string, string[]> };
      setErrors(err.errors || {});
      setMessage(err.message || 'Unable to submit. Please try again.');
    } finally {
      setLoading(false);
    }
  }

  return (
    <form id="enquiry-form" className="enquiry-form" onSubmit={onSubmit} noValidate>
      {success && <div className="alert alert-success">{success}</div>}
      {message && !success && <div className="alert alert-danger">{message}</div>}

      <div className="row g-3">
        <div className="col-md-6">
          <label className="form-label" htmlFor={`${uid}-company`}>
            Business Name *
          </label>
          <input
            type="text"
            name="company"
            id={`${uid}-company`}
            className={`form-control ${errors.company ? 'is-invalid' : ''}`}
            placeholder="Your business name"
            required
          />
          {errors.company && <div className="invalid-feedback d-block">{errors.company[0]}</div>}
        </div>

        <div className="col-md-6">
          <label className="form-label" htmlFor={`${uid}-name`}>
            Your Name *
          </label>
          <input
            type="text"
            name="name"
            id={`${uid}-name`}
            className={`form-control ${errors.name ? 'is-invalid' : ''}`}
            placeholder="Enter your name"
            required
          />
          {errors.name && <div className="invalid-feedback d-block">{errors.name[0]}</div>}
        </div>

        <div className="col-md-6">
          <label className="form-label" htmlFor={`${uid}-email`}>
            Email *
          </label>
          <input
            type="email"
            name="email"
            id={`${uid}-email`}
            className={`form-control ${errors.email ? 'is-invalid' : ''}`}
            placeholder="you@example.com"
            required
          />
          {errors.email && <div className="invalid-feedback d-block">{errors.email[0]}</div>}
        </div>

        <div className="col-md-6">
          <label className="form-label" htmlFor={`${uid}-phone`}>
            Phone
          </label>
          <input
            type="tel"
            name="phone"
            id={`${uid}-phone`}
            className={`form-control ${errors.phone ? 'is-invalid' : ''}`}
            placeholder="+91 XXXXX XXXXX"
          />
          {errors.phone && <div className="invalid-feedback d-block">{errors.phone[0]}</div>}
        </div>

        <div className="col-12">
          <label className="form-label" htmlFor={`${uid}-service`}>
            Service
          </label>
          <select
            name="service"
            id={`${uid}-service`}
            className={`form-select ${errors.service ? 'is-invalid' : ''}`}
          >
            <option value="">Select Service</option>
            <option value="Business Website">Business Website</option>
            <option value="Web Application">Web Application</option>
            <option value="Mobile App">Mobile App</option>
            <option value="SEO">SEO</option>
            <option value="Maintenance">Maintenance</option>
            <option value="E-commerce Application">E-commerce Application</option>
          </select>
          {errors.service && <div className="invalid-feedback d-block">{errors.service[0]}</div>}
        </div>

        <div className="col-12">
          <label className="form-label" htmlFor={`${uid}-message`}>
            Tell us about your project *
          </label>
          <textarea
            name="message"
            id={`${uid}-message`}
            rows={5}
            className={`form-control ${errors.message ? 'is-invalid' : ''}`}
            placeholder="What does your business do? What would you like your website or project to achieve? Include any ideas, features or examples you have in mind."
            required
          />
          {errors.message && <div className="invalid-feedback d-block">{errors.message[0]}</div>}
        </div>

        <div className="d-none" aria-hidden="true">
          <label htmlFor={`${uid}-website`}>Website</label>
          <input type="text" name="website" id={`${uid}-website`} tabIndex={-1} autoComplete="off" />
        </div>

        <div className="col-12">
          <button type="submit" className="btn-primary-custom" disabled={loading}>
            {loading ? (
              <>
                <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true" />
                Submitting...
              </>
            ) : (
              <>
                Send My Inquiry <i className="bi bi-arrow-right" />
              </>
            )}
          </button>
        </div>
      </div>
    </form>
  );
}

export type Company = {
  name: string;
  tagline: string;
  phone: string;
  email: string;
  whatsapp: string;
  location: string;
};

export type WorkItem = {
  image: string;
  title: string;
  category: string;
  type: string;
  desc: string;
  features?: string[];
};

export type WorksResponse = {
  featured: WorkItem[];
  all: WorkItem[];
};

export type AdminUser = {
  id: number;
  name: string;
  email: string;
  role: string;
};

export type Enquiry = {
  id: number;
  name: string;
  email: string;
  phone?: string | null;
  company?: string | null;
  subject?: string | null;
  service?: string | null;
  message?: string;
  admin_notes?: string | null;
  status: string;
  status_label: string;
  created_at?: string;
  updated_at?: string;
};

export type NotificationEmail = {
  id: number;
  email: string;
  label?: string | null;
  is_active: boolean;
  created_at?: string;
};

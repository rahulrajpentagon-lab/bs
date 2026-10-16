import type { NextConfig } from 'next';

const API_ORIGIN = process.env.API_ORIGIN || process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000';

const nextConfig: NextConfig = {
  async rewrites() {
    return [
      {
        source: '/api/:path*',
        destination: `${API_ORIGIN}/api/:path*`,
      },
      {
        source: '/sanctum/:path*',
        destination: `${API_ORIGIN}/sanctum/:path*`,
      },
    ];
  },
};

export default nextConfig;

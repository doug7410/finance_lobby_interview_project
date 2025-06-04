export interface User {
  id: number;
  name: string;
  email: string;
  created_at: string;
  updated_at: string;
}

export interface Property {
  id: number;
  name: string;
  address: string;
  property_type: 'apartment' | 'house' | 'condo' | 'commercial';
  purchase_price: number;
  current_value?: number;
  bedrooms?: number;
  bathrooms?: number;
  square_feet?: number;
  description?: string;
  latest_metric?: any;
  metrics?: any[];
  images?: PropertyImage[];
  created_at: string;
  updated_at: string;
}

export interface PropertyMetric {
  id: number;
  property_id: number;
  monthly_rent: number;
  operating_expenses: number;
  occupancy_rate: number;
  recorded_at: string;
  created_at: string;
  updated_at: string;
}

export interface PropertyImage {
  id: number;
  property_id: number;
  path: string;
  filename: string;
  is_primary: boolean;
  created_at: string;
  updated_at: string;
}

export type DashboardData = {
  total_properties: number;
  total_value: number;
  monthly_income: number;
  average_occupancy: number;
};

export interface LoginForm {
  email: string;
  password: string;
}

export interface RegisterForm {
  name: string;
  email: string;
  password: string;
  password_confirmation: string;
}
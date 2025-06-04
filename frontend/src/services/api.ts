import axios from 'axios';

const API_URL = 'http://localhost:8000/api';

const api = axios.create({
  baseURL: API_URL,
  withCredentials: true,
});

api.interceptors.request.use((config: any) => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export const authService = {
  login: async (email: string, password: string) => {
    const response = await api.post('/login', { email, password });
    localStorage.setItem('token', response.data.token);
    return response.data;
  },

  register: async (data: any) => {
    const response = await api.post('/register', data);
    localStorage.setItem('token', response.data.token);
    return response.data;
  },

  logout: async () => {
    await api.post('/logout');
    localStorage.removeItem('token');
  },

  getUser: () => api.get('/user'),
};

export const propertyService = {
  getAll: () => api.get('/properties'),
  
  getById: (id: any) => api.get(`/properties/${id}`),
  
  create: (data: any) => api.post('/properties', data),
  
  update: (id: number, data: any) => api.put(`/properties/${id}`, data),
  
  delete: (id: number) => api.delete(`/properties/${id}`),
  
  uploadImage: (propertyId: number, formData: FormData) => {
    return api.post(`/properties/${propertyId}/images`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
  },

  getROI: (propertyId: any) => api.get(`/properties/${propertyId}/roi`),
};

export const metricsService = {
  getDashboard: () => api.get('/dashboard'),
  
  addMetric: (propertyId: number, data: any) => 
    api.post(`/properties/${propertyId}/metrics`, data),
};

export default api;
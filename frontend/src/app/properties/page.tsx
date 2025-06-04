'use client';

import { useEffect, useState } from 'react';
import { useRouter } from 'next/navigation';
import { useAuth } from '@/contexts/AuthContext';
import { propertyService } from '@/services/api';
import { Property } from '@/types';
import Link from 'next/link';

export default function PropertiesPage() {
  const { user, loading } = useAuth();
  const router = useRouter();
  const [properties, setProperties] = useState<Property[]>([]);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    if (!loading && !user) {
      router.push('/login');
    }
  }, [user, loading, router]);

  useEffect(() => {
    const fetchProperties = async () => {
      console.log('Fetching properties...');
      try {
        const response = await propertyService.getAll();
        setProperties(response.data.data);
        setIsLoading(false);
      } catch (error) {
        console.error('Error fetching properties:', error);
        setIsLoading(false);
      }
    };

    if (user) {
      fetchProperties();
    }
  }, [user]);

  const PropertyCard = ({ property }: { property: Property }) => {
    return (
      <div 
        className="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow cursor-pointer"
        onClick={() => router.push(`/properties/${property.id}`)}
        style={{ marginBottom: '20px' }} // Inline style
      >
        <h3 className="text-lg font-semibold text-gray-900">{property.name}</h3>
        <p className="text-gray-600">{property.address}</p>
        <div className="mt-4 flex justify-between">
          <div>
            <p className="text-sm text-gray-500">Purchase Price</p>
            <p className="font-semibold">${property.purchase_price.toLocaleString()}</p>
          </div>
          <div>
            <p className="text-sm text-gray-500">Current Value</p>
            <p className="font-semibold">
              ${(property.current_value || property.purchase_price).toLocaleString()}
            </p>
          </div>
        </div>
        {property.latest_metric && (
          <div className="mt-4 border-t pt-4">
            <p className="text-sm text-gray-500">Monthly Rent</p>
            <p className="font-semibold">
              ${property.latest_metric.monthly_rent?.toLocaleString() || 'N/A'}
            </p>
          </div>
        )}
      </div>
    );
  };

  if (loading || isLoading) {
    return <div>Loading...</div>;
  }

  return (
    <div className="min-h-screen bg-gray-100">
      <nav className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-16">
            <div className="flex items-center space-x-4">
              <Link href="/dashboard" className="text-gray-700 hover:text-gray-900">
                ← Dashboard
              </Link>
              <h1 className="text-xl font-semibold">Properties</h1>
            </div>
            <div className="flex items-center">
              <Link
                href="/properties/new"
                className="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700"
              >
                Add Property
              </Link>
            </div>
          </div>
        </div>
      </nav>

      <main className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div className="px-4 py-6 sm:px-0">
          <div className="mb-6">
            <input
              type="text"
              placeholder="Search properties... (not implemented)"
              className="w-full px-4 py-2 border border-gray-300 rounded-md"
              disabled
            />
          </div>

          <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            {properties.map((property) => (
              <PropertyCard key={property.id} property={property} />
            ))}
          </div>

          {properties.length === 0 && (
            <div className="text-center py-12">
              <p className="text-gray-500">No properties found.</p>
            </div>
          )}
        </div>
      </main>
    </div>
  );
}
'use client';

import { useState } from 'react';
import { Users, Star, Award, TrendingUp, CheckCircle, ArrowRight } from 'lucide-react';

interface Consultant {
  id: string;
  name: string;
  title: string;
  expertise: string[];
  experience: number;
  rating: number;
  projects: number;
  avatar: string;
  description: string;
  skills: string[];
  availability: 'available' | 'busy' | 'unavailable';
}

const sampleConsultants: Consultant[] = [
  {
    id: '1',
    name: 'Marie Dubois',
    title: 'Consultante Senior en Stratégie de Croissance',
    expertise: ['Stratégie', 'Analyse de marché', 'Planification'],
    experience: 12,
    rating: 4.9,
    projects: 45,
    avatar: '/api/placeholder/100/100',
    description: 'Experte en accompagnement des PME et startups dans leur stratégie de croissance. Spécialisée dans l\'analyse de marché et la planification stratégique.',
    skills: ['Stratégie', 'Analyse de marché', 'Planification', 'Leadership', 'PME', 'Startups'],
    availability: 'available'
  },
  {
    id: '2',
    name: 'Jean-Luc Martin',
    title: 'Consultant Expert en Transformation Digitale',
    expertise: ['Transformation digitale', 'Change management', 'Technologie'],
    experience: 15,
    rating: 4.8,
    projects: 38,
    avatar: '/api/placeholder/100/100',
    description: 'Spécialiste de la transformation digitale des entreprises. Accompagne les organisations dans leur évolution technologique et culturelle.',
    skills: ['Transformation digitale', 'Change management', 'Technologie', 'Stratégie', 'Organisation'],
    availability: 'busy'
  },
  {
    id: '3',
    name: 'Sophie Chen',
    title: 'Consultante en Marketing Digital',
    expertise: ['Marketing digital', 'SEO', 'Analytics'],
    experience: 8,
    rating: 4.7,
    projects: 32,
    avatar: '/api/placeholder/100/100',
    description: 'Experte en marketing digital et optimisation de la présence en ligne. Spécialisée dans le SEO et l\'analyse des performances.',
    skills: ['Marketing digital', 'SEO', 'Analytics', 'Stratégie', 'ROI', 'Conversion'],
    availability: 'available'
  },
  {
    id: '4',
    name: 'Pierre Moreau',
    title: 'Consultant en Finance & Contrôle',
    expertise: ['Finance', 'Contrôle de gestion', 'Analyse'],
    experience: 10,
    rating: 4.6,
    projects: 28,
    avatar: '/api/placeholder/100/100',
    description: 'Expert en optimisation financière et contrôle de gestion. Accompagne les entreprises dans l\'amélioration de leur performance financière.',
    skills: ['Finance', 'Contrôle de gestion', 'Analyse', 'Reporting', 'Performance', 'Optimisation'],
    availability: 'available'
  }
];

const expertiseAreas = [
  {
    name: 'Stratégie & Croissance',
    description: 'Accompagnement stratégique pour accélérer la croissance de votre entreprise',
    icon: TrendingUp,
    consultants: 12
  },
  {
    name: 'Transformation Digitale',
    description: 'Évolution technologique et culturelle de votre organisation',
    icon: Award,
    consultants: 8
  },
  {
    name: 'Marketing & Ventes',
    description: 'Optimisation de vos stratégies marketing et commerciales',
    icon: Star,
    consultants: 15
  },
  {
    name: 'Finance & Performance',
    description: 'Amélioration de votre performance financière et opérationnelle',
    icon: CheckCircle,
    consultants: 10
  }
];

export default function ConsultantsPage() {
  const [selectedExpertise, setSelectedExpertise] = useState('');
  const [searchTerm, setSearchTerm] = useState('');

  const filteredConsultants = sampleConsultants.filter(consultant => {
    const matchesSearch = consultant.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         consultant.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         consultant.skills.some(skill => skill.toLowerCase().includes(searchTerm.toLowerCase()));
    
    const matchesExpertise = !selectedExpertise || consultant.expertise.includes(selectedExpertise);
    
    return matchesSearch && matchesExpertise;
  });

  const getAvailabilityColor = (status: string) => {
    switch (status) {
      case 'available': return 'bg-green-100 text-green-800';
      case 'busy': return 'bg-yellow-100 text-yellow-800';
      case 'unavailable': return 'bg-red-100 text-red-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  const getAvailabilityText = (status: string) => {
    switch (status) {
      case 'available': return 'Disponible';
      case 'busy': return 'Occupé';
      case 'unavailable': return 'Indisponible';
      default: return 'Inconnu';
    }
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center">
              <h1 className="text-2xl font-bold text-blue-600">Kladriva</h1>
            </div>
            <nav className="hidden md:flex space-x-8">
              <a href="/" className="text-gray-700 hover:text-blue-600 transition-colors">
                Accueil
              </a>
              <a href="/jobs" className="text-gray-700 hover:text-blue-600 transition-colors">
                Offres d'emploi
              </a>
              <a href="/consultants" className="text-blue-600 font-medium">
                Consultants
              </a>
              <a href="/mentoring" className="text-gray-700 hover:text-blue-600 transition-colors">
                Mentoring
              </a>
            </nav>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Page Title */}
        <div className="text-center mb-16">
          <h1 className="text-4xl font-bold text-gray-900 mb-4">
            Nos Consultants Experts
          </h1>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Découvrez notre réseau de consultants qualifiés, sélectionnés et formés 
            pour accélérer la croissance de votre entreprise
          </p>
        </div>

        {/* Expertise Areas */}
        <div className="mb-16">
          <h2 className="text-2xl font-bold text-gray-900 mb-8 text-center">
            Domaines d'expertise
          </h2>
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            {expertiseAreas.map((area, index) => (
              <div key={index} className="bg-white rounded-lg p-6 shadow-sm border hover:shadow-md transition-shadow">
                <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                  <area.icon className="w-6 h-6 text-blue-600" />
                </div>
                <h3 className="text-lg font-semibold text-gray-900 mb-2">{area.name}</h3>
                <p className="text-gray-600 text-sm mb-3">{area.description}</p>
                <p className="text-blue-600 font-medium">{area.consultants} consultants</p>
              </div>
            ))}
          </div>
        </div>

        {/* Search and Filter */}
        <div className="bg-white rounded-lg shadow-sm border p-6 mb-8">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <input
                type="text"
                placeholder="Rechercher un consultant..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              />
            </div>
            <div>
              <select
                value={selectedExpertise}
                onChange={(e) => setSelectedExpertise(e.target.value)}
                className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">Tous les domaines</option>
                <option value="Stratégie">Stratégie</option>
                <option value="Transformation digitale">Transformation digitale</option>
                <option value="Marketing digital">Marketing digital</option>
                <option value="Finance">Finance</option>
              </select>
            </div>
          </div>
        </div>

        {/* Consultants List */}
        <div className="grid md:grid-cols-2 gap-6">
          {filteredConsultants.map(consultant => (
            <div key={consultant.id} className="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow">
              <div className="flex items-start gap-4 mb-4">
                <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                  <Users className="w-8 h-8 text-blue-600" />
                </div>
                <div className="flex-1">
                  <div className="flex items-center justify-between mb-2">
                    <h3 className="text-xl font-semibold text-gray-900">{consultant.name}</h3>
                    <span className={`px-3 py-1 rounded-full text-sm font-medium ${getAvailabilityColor(consultant.availability)}`}>
                      {getAvailabilityText(consultant.availability)}
                    </span>
                  </div>
                  <p className="text-gray-600 mb-2">{consultant.title}</p>
                  <div className="flex items-center gap-4 text-sm text-gray-500">
                    <span className="flex items-center gap-1">
                      <Star className="w-4 h-4 text-yellow-500" />
                      {consultant.rating}
                    </span>
                    <span>{consultant.experience} ans d'expérience</span>
                    <span>{consultant.projects} projets</span>
                  </div>
                </div>
              </div>

              <p className="text-gray-700 mb-4">{consultant.description}</p>

              <div className="mb-4">
                <h4 className="font-medium text-gray-900 mb-2">Expertise principale :</h4>
                <div className="flex flex-wrap gap-2">
                  {consultant.expertise.map((skill, index) => (
                    <span
                      key={index}
                      className="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm"
                    >
                      {skill}
                    </span>
                  ))}
                </div>
              </div>

              <div className="mb-4">
                <h4 className="font-medium text-gray-900 mb-2">Compétences :</h4>
                <div className="flex flex-wrap gap-2">
                  {consultant.skills.slice(0, 4).map((skill, index) => (
                    <span
                      key={index}
                      className="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
                    >
                      {skill}
                    </span>
                  ))}
                  {consultant.skills.length > 4 && (
                    <span className="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                      +{consultant.skills.length - 4} autres
                    </span>
                  )}
                </div>
              </div>

              <div className="flex gap-3">
                <button className="flex-1 bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                  Contacter
                </button>
                <button className="px-4 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                  Voir le profil
                </button>
              </div>
            </div>
          ))}
        </div>

        {/* CTA Section */}
        <div className="mt-16 bg-blue-600 rounded-lg p-8 text-center text-white">
          <h2 className="text-2xl font-bold mb-4">
            Besoin d'un consultant spécifique ?
          </h2>
          <p className="text-blue-100 mb-6 max-w-2xl mx-auto">
            Notre équipe peut vous aider à trouver le consultant parfait pour votre projet. 
            Contactez-nous pour une consultation personnalisée.
          </p>
          <button className="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Demander une consultation
          </button>
        </div>
      </div>
    </div>
  );
}

'use client';

import { useState } from 'react';
import { Search, Filter, MapPin, Briefcase, Clock, DollarSign, Building } from 'lucide-react';

// Types pour les offres d'emploi
interface Job {
  id: string;
  title: string;
  company: string;
  location: string;
  type: 'full-time' | 'part-time' | 'contract' | 'freelance';
  experience: 'entry' | 'mid' | 'senior' | 'expert';
  salary: string;
  skills: string[];
  description: string;
  postedDate: string;
  logo?: string;
}

// Données d'exemple pour le MVP
const sampleJobs: Job[] = [
  {
    id: '1',
    title: 'Consultant Stratégie de Croissance',
    company: 'TechGrowth Inc.',
    location: 'Montréal, QC',
    type: 'full-time',
    experience: 'senior',
    salary: '80,000$ - 120,000$',
    skills: ['Stratégie', 'Analyse de marché', 'Planification', 'Leadership'],
    description: 'Nous recherchons un consultant expérimenté pour accompagner nos clients dans leur stratégie de croissance...',
    postedDate: '2024-01-15'
  },
  {
    id: '2',
    title: 'Consultant Digital Marketing',
    company: 'Digital Solutions',
    location: 'Toronto, ON',
    type: 'contract',
    experience: 'mid',
    salary: '60,000$ - 80,000$',
    skills: ['Marketing digital', 'SEO', 'Analytics', 'Stratégie'],
    description: 'Consultant en marketing digital pour optimiser la présence en ligne de nos clients...',
    postedDate: '2024-01-14'
  },
  {
    id: '3',
    title: 'Consultant Transformation Digitale',
    company: 'InnovateCorp',
    location: 'Vancouver, BC',
    type: 'full-time',
    experience: 'expert',
    salary: '100,000$ - 150,000$',
    skills: ['Transformation digitale', 'Change management', 'Technologie', 'Stratégie'],
    description: 'Expert en transformation digitale pour accompagner les entreprises dans leur évolution...',
    postedDate: '2024-01-13'
  },
  {
    id: '4',
    title: 'Consultant Finance & Contrôle',
    company: 'FinancePro',
    location: 'Calgary, AB',
    type: 'freelance',
    experience: 'mid',
    salary: '70,000$ - 90,000$',
    skills: ['Finance', 'Contrôle de gestion', 'Analyse', 'Reporting'],
    description: 'Consultant financier pour optimiser les processus et améliorer la performance...',
    postedDate: '2024-01-12'
  },
  {
    id: '5',
    title: 'Consultant RH & Organisation',
    company: 'HR Partners',
    location: 'Ottawa, ON',
    type: 'part-time',
    experience: 'senior',
    salary: '65,000$ - 85,000$',
    skills: ['Ressources humaines', 'Organisation', 'Formation', 'Développement'],
    description: 'Consultant RH pour accompagner nos clients dans leur transformation organisationnelle...',
    postedDate: '2024-01-11'
  }
];

export default function JobsPage() {
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedLocation, setSelectedLocation] = useState('');
  const [selectedType, setSelectedType] = useState('');
  const [selectedExperience, setSelectedExperience] = useState('');
  const [jobs, setJobs] = useState<Job[]>(sampleJobs);

  // Filtrage des offres
  const filteredJobs = jobs.filter(job => {
    const matchesSearch = job.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         job.company.toLowerCase().includes(searchTerm.toLowerCase()) ||
                         job.skills.some(skill => skill.toLowerCase().includes(searchTerm.toLowerCase()));
    
    const matchesLocation = !selectedLocation || job.location.includes(selectedLocation);
    const matchesType = !selectedType || job.type === selectedType;
    const matchesExperience = !selectedExperience || job.experience === selectedExperience;
    
    return matchesSearch && matchesLocation && matchesType && matchesExperience;
  });

  const locations = [...new Set(jobs.map(job => job.location.split(',')[0]))];
  const jobTypes = [
    { value: 'full-time', label: 'Temps plein' },
    { value: 'part-time', label: 'Temps partiel' },
    { value: 'contract', label: 'Contrat' },
    { value: 'freelance', label: 'Freelance' }
  ];
  const experienceLevels = [
    { value: 'entry', label: 'Débutant' },
    { value: 'mid', label: 'Intermédiaire' },
    { value: 'senior', label: 'Sénior' },
    { value: 'expert', label: 'Expert' }
  ];

  const getExperienceColor = (level: string) => {
    switch (level) {
      case 'entry': return 'bg-green-100 text-green-800';
      case 'mid': return 'bg-blue-100 text-blue-800';
      case 'senior': return 'bg-purple-100 text-purple-800';
      case 'expert': return 'bg-red-100 text-red-800';
      default: return 'bg-gray-100 text-gray-800';
    }
  };

  const getTypeColor = (type: string) => {
    switch (type) {
      case 'full-time': return 'bg-blue-100 text-blue-800';
      case 'part-time': return 'bg-green-100 text-green-800';
      case 'contract': return 'bg-purple-100 text-purple-800';
      case 'freelance': return 'bg-orange-100 text-orange-800';
      default: return 'bg-gray-100 text-gray-800';
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
              <a href="/jobs" className="text-blue-600 font-medium">
                Offres d'emploi
              </a>
              <a href="/consultants" className="text-gray-700 hover:text-blue-600 transition-colors">
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
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900 mb-2">
            Offres d'emploi
          </h1>
          <p className="text-gray-600">
            Découvrez les opportunités de consulting qui correspondent à votre profil
          </p>
        </div>

        {/* Search and Filters */}
        <div className="bg-white rounded-lg shadow-sm border p-6 mb-8">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            {/* Search */}
            <div className="lg:col-span-2">
              <div className="relative">
                <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" />
                <input
                  type="text"
                  placeholder="Rechercher par titre, entreprise ou compétences..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
              </div>
            </div>

            {/* Location Filter */}
            <div>
              <select
                value={selectedLocation}
                onChange={(e) => setSelectedLocation(e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">Toutes les villes</option>
                {locations.map(location => (
                  <option key={location} value={location}>{location}</option>
                ))}
              </select>
            </div>

            {/* Type Filter */}
            <div>
              <select
                value={selectedType}
                onChange={(e) => setSelectedType(e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">Tous les types</option>
                {jobTypes.map(type => (
                  <option key={type.value} value={type.value}>{type.label}</option>
                ))}
              </select>
            </div>

            {/* Experience Filter */}
            <div>
              <select
                value={selectedExperience}
                onChange={(e) => setSelectedExperience(e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              >
                <option value="">Tous les niveaux</option>
                {experienceLevels.map(level => (
                  <option key={level.value} value={level.value}>{level.label}</option>
                ))}
              </select>
            </div>
          </div>
        </div>

        {/* Results Count */}
        <div className="mb-6">
          <p className="text-gray-600">
            {filteredJobs.length} offre{filteredJobs.length !== 1 ? 's' : ''} trouvée{filteredJobs.length !== 1 ? 's' : ''}
          </p>
        </div>

        {/* Jobs List */}
        <div className="space-y-4">
          {filteredJobs.map(job => (
            <div key={job.id} className="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow">
              <div className="flex items-start justify-between">
                <div className="flex-1">
                  <div className="flex items-center gap-3 mb-2">
                    <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                      <Building className="w-6 h-6 text-blue-600" />
                    </div>
                    <div>
                      <h3 className="text-xl font-semibold text-gray-900 hover:text-blue-600 cursor-pointer">
                        {job.title}
                      </h3>
                      <p className="text-gray-600">{job.company}</p>
                    </div>
                  </div>
                  
                  <div className="flex flex-wrap items-center gap-4 mb-4 text-sm text-gray-500">
                    <div className="flex items-center gap-1">
                      <MapPin className="w-4 h-4" />
                      {job.location}
                    </div>
                    <div className="flex items-center gap-1">
                      <Clock className="w-4 h-4" />
                      {jobTypes.find(t => t.value === job.type)?.label}
                    </div>
                    <div className="flex items-center gap-1">
                      <DollarSign className="w-4 h-4" />
                      {job.salary}
                    </div>
                  </div>

                  <p className="text-gray-700 mb-4 line-clamp-2">
                    {job.description}
                  </p>

                  <div className="flex flex-wrap gap-2 mb-4">
                    {job.skills.slice(0, 4).map((skill, index) => (
                      <span
                        key={index}
                        className="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"
                      >
                        {skill}
                      </span>
                    ))}
                    {job.skills.length > 4 && (
                      <span className="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                        +{job.skills.length - 4} autres
                      </span>
                    )}
                  </div>

                  <div className="flex items-center justify-between">
                    <div className="flex gap-2">
                      <span className={`px-3 py-1 rounded-full text-sm font-medium ${getExperienceColor(job.experience)}`}>
                        {experienceLevels.find(e => e.value === job.experience)?.label}
                      </span>
                      <span className={`px-3 py-1 rounded-full text-sm font-medium ${getTypeColor(job.type)}`}>
                        {jobTypes.find(t => t.value === job.type)?.label}
                      </span>
                    </div>
                    <span className="text-sm text-gray-500">
                      Publié le {new Date(job.postedDate).toLocaleDateString('fr-CA')}
                    </span>
                  </div>
                </div>
              </div>

              <div className="mt-4 pt-4 border-t border-gray-200">
                <button className="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                  Postuler maintenant
                </button>
              </div>
            </div>
          ))}
        </div>

        {/* No Results */}
        {filteredJobs.length === 0 && (
          <div className="text-center py-12">
            <div className="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <Search className="w-8 h-8 text-gray-400" />
            </div>
            <h3 className="text-lg font-medium text-gray-900 mb-2">
              Aucune offre trouvée
            </h3>
            <p className="text-gray-500">
              Essayez de modifier vos critères de recherche ou revenez plus tard.
            </p>
          </div>
        )}
      </div>
    </div>
  );
}

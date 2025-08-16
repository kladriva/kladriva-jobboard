'use client';

import { useState } from 'react';
import { Users, BookOpen, Target, TrendingUp, Award, Star, CheckCircle } from 'lucide-react';

export default function MentoringPage() {
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
              <a href="/consultants" className="text-gray-700 hover:text-blue-600 transition-colors">
                Consultants
              </a>
              <a href="/mentoring" className="text-blue-600 font-medium">
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
            Programme de Mentoring Kladriva
          </h1>
          <p className="text-xl text-gray-600 max-w-3xl mx-auto">
            Développez votre expertise et augmentez votre employabilité grâce à notre 
            système de mentoring personnalisé avec des consultants expérimentés
          </p>
        </div>

        {/* Benefits Section */}
        <div className="mb-16">
          <h2 className="text-2xl font-bold text-gray-900 mb-8 text-center">
            Pourquoi choisir notre mentoring ?
          </h2>
          <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div className="bg-white rounded-lg p-6 shadow-sm border text-center">
              <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <TrendingUp className="w-6 h-6 text-blue-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">Développement des compétences</h3>
              <p className="text-gray-600 text-sm">Améliorez vos compétences techniques et soft skills</p>
            </div>
            
            <div className="bg-white rounded-lg p-6 shadow-sm border text-center">
              <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <Users className="w-6 h-6 text-blue-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">Accès au réseau</h3>
              <p className="text-gray-600 text-sm">Intégrez notre réseau de consultants et d'entreprises</p>
            </div>
            
            <div className="bg-white rounded-lg p-6 shadow-sm border text-center">
              <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <Target className="w-6 h-6 text-blue-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">Accompagnement personnalisé</h3>
              <p className="text-gray-600 text-sm">Bénéficiez d'un suivi sur mesure adapté à vos objectifs</p>
            </div>
            
            <div className="bg-white rounded-lg p-6 shadow-sm border text-center">
              <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                <Award className="w-6 h-6 text-blue-600" />
              </div>
              <h3 className="text-lg font-semibold text-gray-900 mb-2">Certification reconnue</h3>
              <p className="text-gray-600 text-sm">Obtenez des certifications Kladriva valorisées</p>
            </div>
          </div>
        </div>

        {/* Programs Section */}
        <div className="mb-16">
          <h2 className="text-2xl font-bold text-gray-900 mb-8 text-center">
            Nos programmes de mentoring
          </h2>
          
          <div className="grid md:grid-cols-3 gap-6">
            <div className="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow">
              <div className="text-center mb-6">
                <div className="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                  <BookOpen className="w-8 h-8 text-green-600" />
                </div>
                <h3 className="text-xl font-semibold text-gray-900 mb-2">Programme Débutant</h3>
                <p className="text-gray-600 mb-4">Accompagnement complet pour les consultants qui débutent</p>
                <span className="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                  Débutant
                </span>
              </div>

              <div className="mb-6">
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Durée :</span>
                  <span className="font-medium">3 mois</span>
                </div>
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Prix :</span>
                  <span className="text-2xl font-bold text-blue-600">2,400$</span>
                </div>
              </div>

              <button className="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Commencer le programme
              </button>
            </div>

            <div className="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow">
              <div className="text-center mb-6">
                <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                  <Target className="w-8 h-8 text-blue-600" />
                </div>
                <h3 className="text-xl font-semibold text-gray-900 mb-2">Programme Intermédiaire</h3>
                <p className="text-gray-600 mb-4">Perfectionnement des compétences pour consultants expérimentés</p>
                <span className="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                  Intermédiaire
                </span>
              </div>

              <div className="mb-6">
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Durée :</span>
                  <span className="font-medium">6 mois</span>
                </div>
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Prix :</span>
                  <span className="text-2xl font-bold text-blue-600">4,200$</span>
                </div>
              </div>

              <button className="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Commencer le programme
              </button>
            </div>

            <div className="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow">
              <div className="text-center mb-6">
                <div className="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                  <Award className="w-8 h-8 text-purple-600" />
                </div>
                <h3 className="text-xl font-semibold text-gray-900 mb-2">Programme Expert</h3>
                <p className="text-gray-600 mb-4">Transformation en consultant de niveau expert</p>
                <span className="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                  Avancé
                </span>
              </div>

              <div className="mb-6">
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Durée :</span>
                  <span className="font-medium">12 mois</span>
                </div>
                <div className="flex items-center justify-between mb-4">
                  <span className="text-gray-600">Prix :</span>
                  <span className="text-2xl font-bold text-blue-600">7,200$</span>
                </div>
              </div>

              <button className="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Commencer le programme
              </button>
            </div>
          </div>
        </div>

        {/* CTA Section */}
        <div className="bg-blue-600 rounded-lg p-8 text-center text-white">
          <h2 className="text-2xl font-bold mb-4">
            Prêt à accélérer votre carrière ?
          </h2>
          <p className="text-blue-100 mb-6 max-w-2xl mx-auto">
            Rejoignez notre programme de mentoring et transformez votre profil de consultant 
            avec l'accompagnement personnalisé de nos experts.
          </p>
          <button className="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
            Démarrer le mentoring
          </button>
        </div>
      </div>
    </div>
  );
}

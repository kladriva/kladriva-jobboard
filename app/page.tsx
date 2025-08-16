import Link from "next/link";
import { Users, TrendingUp, Lightbulb, ArrowRight } from "lucide-react";

export default function Home() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center">
              <h1 className="text-2xl font-bold text-blue-600">Kladriva</h1>
            </div>
            <nav className="hidden md:flex space-x-8">
              <Link href="/" className="text-gray-700 hover:text-blue-600 transition-colors">
                Accueil
              </Link>
              <Link href="/jobs" className="text-gray-700 hover:text-blue-600 transition-colors">
                Offres d'emploi
              </Link>
              <Link href="/consultants" className="text-gray-700 hover:text-blue-600 transition-colors">
                Consultants
              </Link>
              <Link href="/mentoring" className="text-gray-700 hover:text-blue-600 transition-colors">
                Mentoring
              </Link>
            </nav>
            <div className="flex items-center space-x-4">
              <Link 
                href="/jobs" 
                className="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors"
              >
                Voir les offres
              </Link>
            </div>
          </div>
        </div>
      </header>

      {/* Hero Section */}
      <section className="py-20 px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl mx-auto text-center">
          <h1 className="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
            Accélérez votre croissance avec
            <span className="text-blue-600"> Kladriva</span>
          </h1>
          <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
            Nous connectons les entreprises en croissance avec des consultants experts et accompagnons 
            les consultants débutants vers l&apos;excellence grâce à notre système de mentoring innovant.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link 
              href="/jobs" 
              className="bg-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2"
            >
              Découvrir les offres
              <ArrowRight className="w-5 h-5" />
            </Link>
            <Link 
              href="/mentoring" 
              className="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-blue-50 transition-colors"
            >
              Découvrir le mentoring
            </Link>
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-20 px-4 sm:px-6 lg:px-8 bg-white">
        <div className="max-w-7xl mx-auto">
          <div className="text-center mb-16">
            <h2 className="text-3xl font-bold text-gray-900 mb-4">
              Notre approche unique
            </h2>
            <p className="text-xl text-gray-600 max-w-2xl mx-auto">
              Kladriva combine expertise humaine et technologies IA pour créer un écosystème 
              de croissance performant et durable.
            </p>
          </div>
          
          <div className="grid md:grid-cols-3 gap-8">
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <Users className="w-8 h-8 text-blue-600" />
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-2">
                Consultants sur mesure
              </h3>
              <p className="text-gray-600">
                Nous sélectionnons et formons des consultants experts pour répondre 
                précisément aux besoins de votre entreprise.
              </p>
            </div>
            
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <TrendingUp className="w-8 h-8 text-green-600" />
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-2">
                Accélération de croissance
              </h3>
              <p className="text-gray-600">
                               Notre approche ciblée et nos outils IA vous permettent d&apos;atteindre 
               vos objectifs de croissance plus rapidement.
              </p>
            </div>
            
            <div className="text-center p-6">
              <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <Lightbulb className="w-8 h-8 text-purple-600" />
              </div>
              <h3 className="text-xl font-semibold text-gray-900 mb-2">
                Mentoring intelligent
              </h3>
              <p className="text-gray-600">
                Nous accompagnons les consultants débutants avec un système de mentoring 
                personnalisé pour maximiser leur employabilité.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-20 px-4 sm:px-6 lg:px-8 bg-blue-600">
        <div className="max-w-4xl mx-auto text-center">
          <h2 className="text-3xl font-bold text-white mb-4">
            Prêt à accélérer votre croissance ?
          </h2>
          <p className="text-xl text-blue-100 mb-8">
            Rejoignez l'écosystème Kladriva et transformez votre entreprise avec 
            nos consultants experts et nos outils IA innovants.
          </p>
          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link 
              href="/jobs" 
              className="bg-white text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors"
            >
              Explorer les opportunités
            </Link>
            <Link 
              href="/contact" 
              className="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors"
            >
              Nous contacter
            </Link>
          </div>
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div className="max-w-7xl mx-auto">
          <div className="grid md:grid-cols-4 gap-8">
            <div>
              <h3 className="text-xl font-bold text-blue-400 mb-4">Kladriva</h3>
              <p className="text-gray-400">
                Accélérateur de croissance par l'expertise et l'IA
              </p>
            </div>
            <div>
              <h4 className="font-semibold mb-4">Services</h4>
              <ul className="space-y-2 text-gray-400">
                <li><Link href="/jobs" className="hover:text-white transition-colors">Job Board</Link></li>
                <li><Link href="/consultants" className="hover:text-white transition-colors">Consultants</Link></li>
                <li><Link href="/mentoring" className="hover:text-white transition-colors">Mentoring</Link></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold mb-4">Entreprise</h4>
              <ul className="space-y-2 text-gray-400">
                <li><Link href="/about" className="hover:text-white transition-colors">À propos</Link></li>
                <li><Link href="/contact" className="hover:text-white transition-colors">Contact</Link></li>
                <li><Link href="/careers" className="hover:text-white transition-colors">Carrières</Link></li>
              </ul>
            </div>
            <div>
              <h4 className="font-semibold mb-4">Contact</h4>
              <p className="text-gray-400">
                info@kladriva.com<br />
                +1 (514) XXX-XXXX
              </p>
            </div>
          </div>
          <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2024 Kladriva. Tous droits réservés.</p>
          </div>
        </div>
      </footer>
    </div>
  );
}

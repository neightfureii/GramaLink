document.addEventListener('DOMContentLoaded', () =>{
    const lang = localStorage.getItem('selectedLanguage') || 'en';

    console.log("Selected Language:", lang);

    const translations = {
        en: {
            welcomeTitle: "Welcome to GramaLink !",
            welcomeDesc: "Stay connected with your community and local services.",
            getStarted: "Get Started >",
            announcementTitle: "Announcements",
            announcementText: "Stay updated with the latest announcements from the community and administration.",
            announcementViewMore: "View More",
            rulesTitle: "Rules and Regulations",
            rulesText: "Read the rules and regulations to ensure smooth and effective use of our services.",
            rulesViewMore: "View More",
            communityTitle: "Community Services",
            communityText: "Explore the various services available for the community through Grama-Link.",
            communityViewMore: "View More"

            
        },
        si: {
            welcomeTitle: "Grama Link වෙත සාදරයෙන් පිළිගනිමු !",
            welcomeDesc: "ඔබේ ප්‍රජාව හා දේශීය සේවා සමඟ සම්බන්ධව සිටින්න.",
            getStarted: "ආරම්භ කරන්න >",
            announcementTitle: "නිවේදන",
            announcementText: "ප්‍රජාව සහ පරිපාලනයෙන් නිකුත් වන නවතම නිවේදන ගැන අවධානයෙන් සිටින්න.",
            announcementViewMore: "වැඩිදුර බලන්න",
            rulesTitle: "නීති සහ විධාන",
            rulesText: "අපගේ සේවාවන් නිසි ලෙස භාවිතා කිරීමට නීති හා විධාන කියවන්න.",
            rulesViewMore: "වැඩිදුර බලන්න",
            communityTitle: "ප්‍රජා සේවාවන්",
            communityText: "ග්‍රාම ලින්ක් හරහා ලබා දෙන ප්‍රජා සේවාවන් සොයන්න.",
            communityViewMore: "වැඩිදුර බලන්න"
            
        }
    };
    console.log("Translations Object:", translations);

    const t = translations[lang];

    //Apply translation
    if(!t){
        console.error("Translation not found for language:", lang);
    }else{
        console.log("Applying Translations:", t);
        document.getElementById('welcome-title').textContent = t.welcomeTitle;
        document.getElementById('welcome-description').textContent = t.welcomeDesc;
        document.getElementById('get-start-btn').textContent = t.getStarted;
    
        document.getElementById('announcement-title').textContent = t.announcementTitle;
        document.getElementById('announcement-text').textContent = t.announcementText;
        document.getElementById('announcement-view-more').textContent = t.announcementViewMore;
    
        document.getElementById('rules-title').textContent = t.rulesTitle;
        document.getElementById('rules-text').textContent = t.rulesText;
        document.getElementById('rules-view-more').textContent = t.rulesViewMore;
    
        document.getElementById('community-title').textContent = t.communityTitle;
        document.getElementById('community-text').textContent = t.communityText;
        document.getElementById('community-view-more').textContent = t.communityViewMore;
    }


});


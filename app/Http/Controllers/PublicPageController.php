<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function show(string $page): View
    {
        $pages = [
            'about' => ['About DMI Healths', 'Person-centred support for adults aged 18 and above, designed around the life each person wants to lead.', 'Our Commitment'],
            'mission' => ['Our Mission', 'To help adults with disabilities and special needs live with dignity, confidence and meaningful connection.', 'What Guides Us'],
            'our-approach' => ['Our Approach', 'Person-centered support begins with listening—to each person, their family and the people they trust.', 'How We Support People'],
            'resources' => ['Resources', 'Helpful information, community resources and future DMI Healths updates will be available here.', 'Resources & Updates'],
            'faq' => ['Frequently Asked Questions', 'Clear answers for individuals, families and community partners.', 'Questions, Answered'],
            'support-us' => ['Support DMI Healths', 'Your generosity helps us provide compassionate care, meaningful opportunities and a stronger sense of community for the people we support.', 'Make a Meaningful Difference'],
            'gallery' => ['Life at DMI Healths', 'Development imagery is used only until DMI provides approved photographs and consent documentation.', 'Gallery'],
            'team' => ['Our Team', 'DMI will introduce approved staff and leadership here.', 'Our People'],
        ];

        abort_unless(isset($pages[$page]), 404);
        return view('pages.standard', ['page' => $page, 'content' => $pages[$page]]);
    }

    public function service(string $service): View
    {
        if ($service === 'residential-care') {
            return view('pages.services');
        }

        $services = [
            'residential-care' => ['Residential Care', 'A comfortable, secure residential setting for adults who require help with daily living while building independence.', ['Daily living assistance', 'Personal care and medication support', 'Around-the-clock support', 'A safe, welcoming home environment']],
            'personalized-care' => ['Personalized Care Plans', 'Support plans are shaped around each person’s needs, goals, preferences and strengths in collaboration with families and healthcare professionals.', ['Individual goals and preferences', 'Family and professional collaboration', 'Regular plan reviews']],
            'social-recreational' => ['Social & Recreational Activities', 'Meaningful activities can build connection, confidence and joy.', ['Arts, crafts and games', 'Group activities and outings', 'Opportunities for friendship and engagement']],
            'health-wellness' => ['Health & Wellness', 'Everyday wellness is supported through coordination, healthy routines and activities that feel good.', ['Medication management assistance', 'Health-check and therapy coordination', 'Nutrition, movement and healthy routines']],
            'community-integration' => ['Community Integration', 'We support people to explore interests, form relationships and take part in their wider community.', ['Local events and social gatherings', 'Volunteer opportunities', 'Personal interests and meaningful relationships']],
        ];
        abort_unless(isset($services[$service]), 404);
        return view('pages.service', ['service' => $services[$service]]);
    }

    public function eligibility(string $condition): View
    {
        $content = config("eligibility.{$condition}");
        abort_unless($content, 404);
        return view('pages.eligibility', compact('content'));
    }
}

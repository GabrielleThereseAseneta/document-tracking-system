@extends('layouts.dashboard')

{{-- Start of the 'content' section that will be injected into the layout --}}
@section('content')

    {{-- Hero section with main call-to-actions --}}
    <div class="hero">
        <h1>Efficient Document Workflow Management</h1>
        <p>Streamline your internal communication and document tracking with our powerful system.</p>

        {{-- Link to the Weekly Mailing documents page --}}
        <a href="{{ route('weeklymailing.index') }}" class="cta-button">View Documents</a>

        {{-- Link to scroll to the features section --}}
        <a href="#features" class="cta-button learn-more-button">Learn More</a>
    </div>

    {{-- Features section highlights key parts of the system --}}
    <div class="features" id="features">
        {{-- Special Order Tracking --}}
        <div class="feature" onclick="location.href='{{ route('specialorder.index') }}'">
            <i class="fas fa-file-signature"></i>
            <h3>Special Order Tracking</h3>
            <p>Manage and track special orders, ensuring timely processing and delivery.</p>
        </div>

        {{-- Weekly Mailing Management --}}
        <div class="feature" onclick="location.href='{{ route('weeklymailing.index') }}'">
            <i class="fas fa-envelope"></i>
            <h3>Weekly Mailing Management</h3>
            <p>Organize, schedule, and track your weekly mailings with ease.</p>
        </div>

        {{-- Memorandum Distribution --}}
        <div class="feature" onclick="location.href='{{ route('memorandum.index') }}'">
            <i class="fas fa-sticky-note"></i>
            <h3>Memorandum Distribution</h3>
            <p>Efficiently distribute and track memoranda across your organization.</p>
        </div>

        {{-- Advisory Scheduling --}}
        <div class="feature" onclick="location.href='{{ route('advisory.index') }}'">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Advisory Scheduling</h3>
            <p>Schedule and manage advisories for important announcements and updates.</p>
        </div>
    </div>

    {{-- Final call-to-action section --}}
    <div class="get-started">
        <h2>Ready to Streamline Your Internal Communications?</h2>

        {{-- Link to create a new weekly mailing entry --}}
        <a href="{{ route('weeklymailing.create') }}" class="get-started-button">Create an Entry</a>
    </div>

@endsection

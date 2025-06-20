@extends('layout.layout_office')

@section('title', 'Profile')

@section('content')

<div class="container py-4">
    <div class="card shadow-sm p-4 text-center">
        {{-- Profile Image --}}
        <div class="mb-3 position-relative d-inline-block">
            <img
                id="profileImage"
                src="{{ $office->image_path ? asset('images/' . $office->image_path) : asset('logo.png') }}"
                alt="Profile Image"
                class="rounded-circle border"
                style="width: 150px; height: 150px; object-fit: cover;"
            >

            {{-- Hidden Upload Form --}}
            <form id="imageUploadForm" action="{{ route('office.profile.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile_image" id="imageInput" accept="image/*" hidden>
            </form>

            {{-- Trigger Button --}}
            <button type="button" class="btn btn-sm btn-primary mt-2" onclick="document.getElementById('imageInput').click()">
                Change Image
            </button>
        </div>

        {{-- Info --}}
        <h4 class="fw-bold mt-3">{{ $office->office_admin }}</h4>
        <p class="text-muted mb-0">Office ID: {{ $office->office_id }}</p>
        <p class="text-muted">{{ $office->office_name }}</p>
    </div>
</div>

<script>
    // Auto-submit form when file is selected
    document.getElementById('imageInput').addEventListener('change', function () {
        if (this.files && this.files[0]) {
            document.getElementById('imageUploadForm').submit();
        }
    });
</script>

@endsection

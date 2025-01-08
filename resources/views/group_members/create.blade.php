@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Anggota Kelompok untuk Proyek: {{ $project->name }}</h1>

    {{-- Ketua Proyek --}}
    <div class="mb-3">
        <label class="form-label">Ketua Proyek</label>
        <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
    </div>

    {{-- Form Tambah Anggota --}}
    <form action="{{ route('group-members.store', $project->id) }}" method="POST">
        @csrf

        <div id="members-container">
            <div class="member-item mb-3">
                <label class="form-label">Anggota</label>
                <select name="members[0][user_id]" class="form-select" required>
                    <option value="">Pilih Anggota</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="members[0][role]" value="member">
            </div>
        </div>

        {{-- Tombol Tambah Anggota --}}
        <button type="button" class="btn btn-secondary" id="add-member-btn">Tambah Anggota</button>

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<script>
    let memberIndex = 1;
    document.getElementById('add-member-btn').addEventListener('click', function () {
        const container = document.getElementById('members-container');
        const newMember = document.createElement('div');
        newMember.classList.add('member-item', 'mb-3');
        newMember.innerHTML = `
            <label class="form-label">Anggota</label>
            <select name="members[${memberIndex}][user_id]" class="form-select" required>
                <option value="">Pilih Anggota</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <input type="hidden" name="members[${memberIndex}][role]" value="member">
        `;
        container.appendChild(newMember);
        memberIndex++;
    });
</script>
@endsection
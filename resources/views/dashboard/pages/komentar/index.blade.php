@extends('dashboard.layouts.main')

@section('container')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <div class="card card-xxl-stretch mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Comment Management</span>
                        <span class="text-muted mt-1 fw-bold fs-7">List of all comments</span>
                    </h3>
                    <div class="card-toolbar">
                        <!-- Tombol untuk menambah komentar baru jika diperlukan -->
                        <a href="{{ route('komentar.create') }}" class="btn btn-sm btn-light btn-active-primary">
                            <i class="fas fa-plus text-primary"></i> New Comment
                        </a>
                    </div>
                </div>

                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-150px">User</th>
                                    <th class="min-w-150px">Comment</th>
                                    <th class="min-w-150px">Admin Reply</th>
                                    <th class="min-w-100px">Rating</th> <!-- Kolom Rating -->
                                    <th class="min-w-100px text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($komentars as $komentar)
                                    <tr>
                                        <td>{{ $komentar->user->name }}</td>
                                        <td>{{ $komentar->komentar }}</td>
                                        <td>{{ $komentar->balasan_admin ?? 'No reply' }}</td>
                                        <!-- Menampilkan Rating -->
                                        <td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $komentar->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-secondary"></i>
                                                @endif
                                            @endfor
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('komentar.edit', $komentar->id) }}"
                                                class="btn btn-icon btn-light btn-sm me-1 text-primary">
                                                <i class="fas fa-comment"></i>
                                            </a>

                                            <form action="{{ route('komentar.destroy', $komentar->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-light btn-sm text-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection

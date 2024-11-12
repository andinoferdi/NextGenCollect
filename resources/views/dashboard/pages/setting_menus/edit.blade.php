@extends('dashboard.layouts.main')

@section('container')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <h3 class="mb-5">Edit Setting Menu</h3>

            <form action="{{ route('setting_menus.update', $id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Role Selection -->
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role_id" class="form-select" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $id ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Menu and Submenu Selection -->
                <div class="mb-3">
                    <label class="form-label">Menu and Submenus</label>
                    <div>
                        @foreach($menus as $menu)
                            <div>
                                <!-- Checkbox for menu -->
                                <input type="checkbox" class="menu-checkbox" id="menu_{{ $menu->id }}" name="menu_id[]" value="{{ $menu->id }}" data-id="{{ $menu->id }}"
                                    {{ isset($selectedSettings[$menu->id]) ? 'checked' : '' }}>
                                <label for="menu_{{ $menu->id }}">{{ $menu->nama_menu }}</label>

                                <!-- Submenus -->
                                <div class="ms-4">
                                    @foreach($menu->submenus as $submenu)
                                        <div>
                                            <input type="checkbox" class="submenu-checkbox submenu-for-{{ $menu->id }}" name="submenu_ids[{{ $menu->id }}][]" value="{{ $submenu->id }}"
                                                {{ isset($selectedSettings[$menu->id]) && in_array($submenu->id, $selectedSettings[$menu->id]->pluck('submenu_id')->toArray()) ? 'checked' : '' }}>
                                            <label>{{ $submenu->nama_submenu }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('setting_menus.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to handle the automatic selection of submenus
        document.addEventListener('DOMContentLoaded', function () {
            const menuCheckboxes = document.querySelectorAll('.menu-checkbox');

            menuCheckboxes.forEach(menuCheckbox => {
                menuCheckbox.addEventListener('change', function () {
                    const menuId = this.getAttribute('data-id');
                    const submenuCheckboxes = document.querySelectorAll('.submenu-for-' + menuId);

                    submenuCheckboxes.forEach(submenuCheckbox => {
                        submenuCheckbox.checked = this.checked;
                    });
                });
            });
        });
    </script>
@endsection
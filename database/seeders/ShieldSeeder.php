<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions that should exist
        $permissions = [
            // User
            'ViewAny:User',
            'View:User',
            'Create:User',
            'Update:User',
            'Delete:User',
            'Restore:User',
            'RestoreAny:User',
            'Replicate:User',
            'Reorder:User',
            'ForceDelete:User',
            'ForceDeleteAny:User',

            // Role
            'ViewAny:Role',
            'View:Role',
            'Create:Role',
            'Update:Role',
            'Delete:Role',
            'DeleteAny:Role',

            // Post
            'ViewAny:Post',
            'View:Post',
            'Create:Post',
            'Update:Post',
            'Delete:Post',
            'Restore:Post',
            'RestoreAny:Post',
            'Replicate:Post',
            'Reorder:Post',
            'ForceDelete:Post',
            'ForceDeleteAny:Post',
            'Publish:Post',
            'Unpublish:Post',

            // Tag
            'ViewAny:Tag',
            'View:Tag',
            'Create:Tag',
            'Update:Tag',
            'Delete:Tag',
            'Restore:Tag',
            'RestoreAny:Tag',
            'Replicate:Tag',
            'Reorder:Tag',
            'ForceDelete:Tag',
            'ForceDeleteAny:Tag',

            // SambutanPimpinan
            'ViewAny:SambutanPimpinan',
            'View:SambutanPimpinan',
            'Create:SambutanPimpinan',
            'Update:SambutanPimpinan',
            'Delete:SambutanPimpinan',
            'DeleteAny:SambutanPimpinan',
            'Restore:SambutanPimpinan',
            'RestoreAny:SambutanPimpinan',
            'Replicate:SambutanPimpinan',
            'Reorder:SambutanPimpinan',
            'ForceDelete:SambutanPimpinan',
            'ForceDeleteAny:SambutanPimpinan',

            // AgendaKegiatan
            'ViewAny:AgendaKegiatan',
            'View:AgendaKegiatan',
            'Create:AgendaKegiatan',
            'Update:AgendaKegiatan',
            'Delete:AgendaKegiatan',
            'DeleteAny:AgendaKegiatan',

            // Banner
            'ViewAny:Banner',
            'View:Banner',
            'Create:Banner',
            'Update:Banner',
            'Delete:Banner',
            'DeleteAny:Banner',

            // Dokumen
            'ViewAny:Dokumen',
            'View:Dokumen',
            'Create:Dokumen',
            'Update:Dokumen',
            'Delete:Dokumen',
            'DeleteAny:Dokumen',

            // ExternalLink
            'ViewAny:ExternalLink',
            'View:ExternalLink',
            'Create:ExternalLink',
            'Update:ExternalLink',
            'Delete:ExternalLink',
            'DeleteAny:ExternalLink',

            // Gallery
            'ViewAny:Gallery',
            'View:Gallery',
            'Create:Gallery',
            'Update:Gallery',
            'Delete:Gallery',
            'DeleteAny:Gallery',

            // Infografis
            'ViewAny:Infografis',
            'View:Infografis',
            'Create:Infografis',
            'Update:Infografis',
            'Delete:Infografis',
            'DeleteAny:Infografis',

            // Layanan
            'ViewAny:Layanan',
            'View:Layanan',
            'Create:Layanan',
            'Update:Layanan',
            'Delete:Layanan',
            'DeleteAny:Layanan',

            // Pengaturan
            'ViewAny:Pengaturan',
            'View:Pengaturan',
            'Create:Pengaturan',
            'Update:Pengaturan',
            'Delete:Pengaturan',
            'DeleteAny:Pengaturan',

            // Pengumuman
            'ViewAny:Pengumuman',
            'View:Pengumuman',
            'Create:Pengumuman',
            'Update:Pengumuman',
            'Delete:Pengumuman',
            'DeleteAny:Pengumuman',

            // StrukturOrganisasi
            'ViewAny:StrukturOrganisasi',
            'View:StrukturOrganisasi',
            'Create:StrukturOrganisasi',
            'Update:StrukturOrganisasi',
            'Delete:StrukturOrganisasi',
            'DeleteAny:StrukturOrganisasi',

            // Visit
            'ViewAny:Visit',
            'View:Visit',
            'Create:Visit',
            'Update:Visit',
            'Delete:Visit',
            'DeleteAny:Visit',

            // Widget
            'page_Dashboard',
            'page_Logs',
            'widget_AccountWidget',
            'widget_FilamentInfoWidget',
        ];

        // Create all permissions
        $createdPermissions = [];
        foreach ($permissions as $permission) {
            // Ensure permission is a string and trim any whitespace
            $permission = is_string($permission) ? trim($permission) : $permission;
            if (is_string($permission) && !empty($permission)) {
                $createdPermissions[] = Permission::firstOrCreate(
                    ['name' => $permission],
                )->name; // Store the permission name as a string
            }
        }

        // Create roles with their permissions
        $roles = [
            [
                'name' => 'super_admin',
                'guard_name' => 'web',
                'permissions' => ['*'], // All permissions
                'description' => 'Super Administrator dengan akses penuh ke semua fitur'
            ],
            [
                'name' => 'administrator',
                'guard_name' => 'web',
                'permissions' => array_filter($permissions, function ($permission) {
                    // Admin can do almost anything except deleting users or roles or system settings
                    // Assuming 'Pengaturan' is system setting
                    return !str_contains($permission, 'Delete:User') &&
                        !str_contains($permission, 'ForceDelete:User') &&
                        !str_contains($permission, 'Delete:Role') &&
                        !str_contains($permission, 'Delete:Pengaturan');
                }),
                'description' => 'Administrator dengan kendali penuh atas situs, kecuali hapus user/role'
            ],
            [
                'name' => 'editor',
                'guard_name' => 'web',
                'permissions' => array_filter($permissions, function ($permission) {
                    // Editor manages content
                    $contentResources = [
                        'Post',
                        'Tag',
                        'SambutanPimpinan',
                        'AgendaKegiatan',
                        'Banner',
                        'Dokumen',
                        'ExternalLink',
                        'Gallery',
                        'Infografis',
                        'Layanan',
                        'Pengumuman'
                    ];

                    foreach ($contentResources as $resource) {
                        if (str_ends_with($permission, ":$resource")) {
                            return true;
                        }
                    }

                    return $permission === 'page_Dashboard';
                }),
                'description' => 'Dapat mengelola dan mempublikasikan konten'
            ],
            [
                'name' => 'author',
                'guard_name' => 'web',
                'permissions' => [
                    'ViewAny:Post',
                    'View:Post',
                    'Create:Post',
                    'Update:Post', // Will be restricted by Policy to own posts
                    'Delete:Post', // Will be restricted by Policy to own posts
                    'ViewAny:Tag',
                    'View:Tag',
                    'page_Dashboard'
                ],
                'description' => 'Penulis (Bisa tulis & publish sendiri)'
            ],
            [
                'name' => 'contributor',
                'guard_name' => 'web',
                'permissions' => [
                    'ViewAny:Post',
                    'View:Post',
                    'Create:Post',
                    'Update:Post', // Will be restricted by Policy to own posts
                    'ViewAny:Tag',
                    'View:Tag',
                    'page_Dashboard'
                ],
                'description' => 'Kontributor (Tulis tanpa publish)'
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleData) {
            // Ensure role name is a string
            $roleName = is_string($roleData['name']) ? trim($roleData['name']) : '';
            if (empty($roleName)) continue;

            $role = Role::firstOrCreate(
                ['name' => $roleName],
                [
                    'name' => $roleName,
                    'guard_name' => is_string($roleData['guard_name'] ?? 'web') ? $roleData['guard_name'] : 'web'
                ]
            );

            // Handle permissions
            $permissionsToSync = [];

            // Handle wildcard permission (super_admin case)
            if (in_array('*', $roleData['permissions'] ?? [])) {
                $permissionsToSync = Permission::all()->pluck('name')->toArray();
            }
            // Handle array of permissions
            elseif (is_array($roleData['permissions'] ?? null)) {
                $permissionsToSync = array_filter(
                    $roleData['permissions'],
                    fn($p) => is_string($p) && !empty(trim($p))
                );
            }

            // Only sync if we have permissions to sync
            if (!empty($permissionsToSync)) {
                $role->syncPermissions($permissionsToSync);
            }

            // Update description if provided
            if (isset($roleData['description'])) {
                $role->update(['description' => $roleData['description']]);
            }
        }

        $this->command->info('Shield Seeding Completed.');
    }
}

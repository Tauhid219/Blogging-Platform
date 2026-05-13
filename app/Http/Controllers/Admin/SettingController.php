<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:manage settings', only: ['edit']),
            new Middleware('permission:edit settings', only: ['update']),
        ];
    }

    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => Setting::where('group', 'site')->get()->keyBy('key'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'fallback_post_image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ]);

        unset($data['fallback_post_image_upload']);

        $fallbackImageSetting = Setting::where('group', 'site')->where('key', 'fallback_post_image_path')->first();
        $previousFallbackImagePath = data_get($fallbackImageSetting?->value, 'fallback_post_image_path');

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['group' => 'site', 'key' => $key],
                ['type' => 'string', 'autoload' => true, 'value' => [$key => $value]]
            );
        }

        if ($request->hasFile('fallback_post_image_upload')) {
            $storedPath = $request->file('fallback_post_image_upload')->store('settings/fallback-images', 'public');

            if (filled($previousFallbackImagePath) && Storage::disk('public')->exists($previousFallbackImagePath)) {
                Storage::disk('public')->delete($previousFallbackImagePath);
            }

            Setting::updateOrCreate(
                ['group' => 'site', 'key' => 'fallback_post_image_path'],
                ['type' => 'string', 'autoload' => true, 'value' => ['fallback_post_image_path' => $storedPath]]
            );
        }

        return redirect()->route('admin.settings.edit')->with('status', 'Settings updated successfully.');
    }
}

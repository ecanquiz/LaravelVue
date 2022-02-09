<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneralSettingsController extends Controller
{
    function edit(GeneralSettings $settings)
    {
        return Inertia::render("Settings/Edit", [
            "default_pagination" => $settings->default_pagination,
            "footer_message" => $settings->footer_message,
        ]);
    }
    function update(Request $request, GeneralSettings $settings)
    {
        $data = $request->validate([
            "default_pagination" => "required",
            "footer_message" => "required",
        ]);

        $settings->default_pagination = $data["default_pagination"];
        $settings->footer_message = $data["footer_message"];
        $settings->save();
        return redirect()
            ->route("settings")
            ->with("success", "Ajustes guardados");
    }
}

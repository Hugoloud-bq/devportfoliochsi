<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::where('user_id', auth()->id())->first();
        
        if (!$about) {
            $about = About::create([
                'user_id' => auth()->id(),
                'name' => auth()->user()->name,
                'title' => 'Студент | Разработчик',
                'university' => 'Колледж/Университет',
                'specialty' => 'Инструментальные средства разработки ПО',
                'course' => 3
            ]);
        }
        
        return view('about', compact('about'));
    }

    public function edit()
    {
        $about = About::where('user_id', auth()->id())->first();
        
        if (!$about) {
            $about = About::create([
                'user_id' => auth()->id(),
                'name' => auth()->user()->name,
                'title' => 'Студент | Разработчик',
                'university' => 'Колледж/Университет',
                'specialty' => 'Инструментальные средства разработки ПО',
                'course' => 3
            ]);
        }
        
        return view('about-edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::where('user_id', auth()->id())->first();
        
        if (!$about) {
            return redirect()->back()->with('error', 'Профиль не найден');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'github' => 'nullable|url|max:255',
            'telegram' => 'nullable|string|max:255',
            'university' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'course' => 'required|integer|min:1|max:6',
            'skills' => 'nullable|string',
        ]);

        // Обработка навыков (преобразуем строку в массив)
        if ($request->filled('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            $data['skills'] = $skillsArray;
        } else {
            $data['skills'] = [];
        }

        // Обработка аватара
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар
            if ($about->avatar) {
                Storage::disk('public')->delete($about->avatar);
            }
            
            // Сохраняем новый
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $about->update($data);
        
        return redirect()->route('about')->with('success', 'Информация обновлена!');
    }
}
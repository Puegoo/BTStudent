<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Saving;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->isAdmin) {
                return redirect('/home')->with('error', 'Nie masz uprawnień do tej strony.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $totalIncome = Transaction::where('type', 'Dochody')->sum('amount');
        $totalExpenses = Transaction::where('type', 'Wydatki')->sum('amount');
        $balance = $totalIncome - $totalExpenses;
        $recentTransactions = Transaction::orderBy('date', 'desc')->take(5)->get();

        return view('dashboard', compact('totalIncome', 'totalExpenses', 'balance', 'recentTransactions'));
    }

    public function transactions()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function createTransaction()
    {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Dochody,Wydatki',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:0.01|max:99999999.99',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transakcja została dodana.');
    }

    public function editTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function updateTransaction(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:Dochody,Wydatki',
            'category_id' => 'required',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transakcja została zaktualizowana.');
    }

    public function destroyTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transakcja została usunięta.');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('categories.create');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategoria została dodana.');
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategoria została zaktualizowana.');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);

        if ($category->transactions()->exists()) {
            return redirect()->route('categories.index')->with('error', 'Nie można usunąć kategorii, która ma powiązane transakcje.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategoria została usunięta.');
    }

    public function savings()
    {
        $savings = Saving::all();
        return view('savings.index', compact('savings'));
    }

    public function createSaving()
    {
        return view('savings.create');
    }

    public function storeSaving(Request $request)
    {
        $request->validate([
            'goal' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'date' => 'required|date',
        ]);

        Saving::create([
            'goal' => $request->goal,
            'amount' => $request->amount,
            'date' => $request->date,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('savings.index')->with('success', 'Oszczędność została dodana.');
    }

    public function editSaving($id)
    {
        $saving = Saving::findOrFail($id);
        return view('savings.edit', compact('saving'));
    }

    public function updateSaving(Request $request, $id)
    {
        $request->validate([
            'goal' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'date' => 'required|date',
        ]);

        $saving = Saving::findOrFail($id);
        $saving->update($request->all());
        return redirect()->route('savings.index')->with('success', 'Oszczędność została zaktualizowana.');
    }

    public function destroySaving($id)
    {
        $saving = Saving::findOrFail($id);
        $saving->delete();
        return redirect()->route('savings.index')->with('success', 'Oszczędność została usunięta.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profile_edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil został zaktualizowany.');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->file('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('images', $fileName, 'public');

            if ($user->profile_photo && Storage::disk('public')->exists('images/' . $user->profile_photo)) {
                Storage::disk('public')->delete('images/' . $user->profile_photo);
            }

            $user->profile_photo = $fileName;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Zdjęcie profilowe zostało zaktualizowane.');
    }

    public function users()
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'isAdmin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->isAdmin,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Użytkownik został dodany.');
    }

    public function editUser($id)
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'isAdmin' => 'required|boolean',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->isAdmin = $request->isAdmin;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Użytkownik został zaktualizowany.');
    }

    public function destroyUser($id)
    {
        if (!auth()->user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Użytkownik został usunięty.');
    }

    public function getAdminChartData()
    {
        $transactions = Transaction::selectRaw('MONTH(date) as month, type, SUM(amount) as total')
            ->groupBy('month', 'type')
            ->get();

        $months = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
        $incomes = array_fill(0, 12, 0);
        $expenses = array_fill(0, 12, 0);

        foreach ($transactions as $transaction) {
            if ($transaction->type === 'Dochody') {
                $incomes[$transaction->month - 1] = $transaction->total;
            } elseif ($transaction->type === 'Wydatki') {
                $expenses[$transaction->month - 1] = $transaction->total;
            }
        }

        return response()->json([
            'labels' => $months,
            'income' => $incomes,
            'expenses' => $expenses,
        ]);
    }
}
?>

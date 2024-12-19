<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        // Menggunakan paginate() untuk mendapatkan data dengan pagination
        $produk = Produk::paginate(10); // Menampilkan 10 produk per halaman
        return view('admin.produk.index', compact('produk'));
    }

    public function create()
    {
        return view('admin.produk.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'size' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi gambar
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'image.required' => 'Gambar Harus di isi',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat JPEG, PNG, JPG, atau GIF.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Membuat instance baru Produk
        $Produk = new Produk();
        $Produk->name = $validated['name'];
        $Produk->price = $validated['price'];
        $Produk->description = $validated['description'];
        $Produk->stock = $validated['stock'];
        $Produk->size = $validated['size'];

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            // Menyimpan gambar di folder public/produk dan menyimpan path-nya
            $path = $request->file('image')->store('public/produk');
            // Menyimpan nama file gambar (tanpa path folder)
            $Produk->image = basename($path);
        }

        // Menyimpan data produk ke database
        $Produk->save();

        // Redirect ke halaman index produk
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'size' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Validasi gambar
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'description.required' => 'Deskripsi produk wajib diisi.',
            'stock.required' => 'Stok produk wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka bulat.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat JPEG, PNG, JPG, atau GIF.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Mencari produk berdasarkan id
        $Produk = Produk::findOrFail($id);

        // Mengupdate produk dengan data yang sudah divalidasi
        $Produk->name = $validated['name'];
        $Produk->price = $validated['price'];
        $Produk->description = $validated['description'];
        $Produk->stock = $validated['stock'];
        $Produk->size = $validated['size'];

        // Menyimpan gambar jika ada dan mengganti gambar lama
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($Produk->image) {
                Storage::delete('public/produk/' . $Produk->image);
            }

            // Menyimpan gambar baru di folder public/produk dan menyimpan path-nya
            $path = $request->file('image')->store('public/produk');
            // Menyimpan nama file gambar (tanpa path folder)
            $Produk->image = basename($path);
        }

        // Menyimpan perubahan produk ke database
        $Produk->save();

        // Redirect ke halaman index produk dengan pesan sukses
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Mencari produk berdasarkan id
        $Produk = Produk::findOrFail($id);

        // Menghapus gambar jika ada
        if ($Produk->image) {
            // Menghapus gambar yang ada di storage
            Storage::delete('public/produk/' . $Produk->image);
        }

        // Menghapus data produk dari database
        $Produk->delete();

        // Redirect ke halaman index produk dengan pesan sukses
        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}

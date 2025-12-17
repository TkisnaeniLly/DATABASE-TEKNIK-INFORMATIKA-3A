### 🛒 Cart / Keranjang

| Method | Endpoint             | Deskripsi                     | Auth |
| ------ | -------------------- | ----------------------------- | ---- |
| GET    | `/api/cart`          | Ambil keranjang milik user    | JWT  |
| POST   | `/api/cart/add`      | Tambah item ke keranjang      | JWT  |
| PUT    | `/api/cart/update`   | Update qty & varian item cart | JWT  |
| DELETE | `/api/cart/delete`   | Kurangi qty / hapus item cart | JWT  |
| POST   | `/api/cart/checkout` | Checkout keranjang user       | JWT  |

### GET `/api/cart`

Mengambil daftar keranjang milik user.

#### ✅ Response (200)

```json
{
  "statusCode": 200,
  "message": "Data keranjang",
  "data": {
    "cart_id": 1,
    "items": [
      {
        "cart_item_id": 1,
        "qty": 4,
        "price": "99000.00",
        "subtotal": 396000,
        "variant": {
          "id": 1,
          "type": "SIZE",
          "value": "M"
        },
        "product": {
          "id": 1,
          "name": "Erigo T-Shirt Basic Oversize",
          "slug": "erigo-t-shirt-basic-oversize",
          "image": "/images/products/erigo-tshirt-1.jpg"
        },
        "stock": {
          "qty": 50,
          "status": "AVAILABLE"
        }
      }
    ],
    "total_qty": 4,
    "total_price": 396000
  }
}
```

### POST `/api/cart/add`

Menambahkan item ke keranjang.

#### Body :

```json
{
  "variant_id": 2,
  "qty": 2
}
```

#### ✅ Response (200)

```json
{
  "statusCode": 200,
  "message": "Produk berhasil ditambahkan ke keranjang",
  "data": {
    "id": 3,
    "cart_id": 1,
    "variant_id": 2,
    "qty": 2,
    "updated_at": "2025-12-17T05:58:54.967Z",
    "created_at": "2025-12-17T05:58:54.967Z"
  }
}
```

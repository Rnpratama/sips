<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Sale_m');
        $this->load->model('Customer_m');
        $this->load->model('Item_m');
    }

    public function index() {
        $data['customer'] = $this->Customer_m->get()->result();
        $data['invoice'] = $this->Sale_m->invoice_no();
        $data['item'] = $this->Item_m->get()->result();
        $this->template->load('template', 'transaction/sale/sale_form', $data);
    }

    // public function process() {
    //     if ($this->input->post('add_to_cart')) {
    //         $data = [
    //             'item_id' => $this->input->post('item_id'),
    //             'price' => $this->input->post('price'),
    //             'qty' => $this->input->post('qty'),
    //             'discount' => $this->input->post('discount'),
    //             'total' => $this->input->post('total')
    //         ];

    //         // Validasi data
    //         if (!$data['item_id'] || !$data['price'] || !$data['qty'] || $data['qty'] <= 0) {
    //             $this->session->set_flashdata('error', 'Invalid data for cart.');
    //             redirect('sale');
    //         }

    //         // Cek apakah item sudah ada di cart
    //         $existing_cart = $this->db->get_where('t_cart', ['item_id' => $data['item_id']])->row();
    //         if ($existing_cart) {
    //             $this->session->set_flashdata('error', 'Item already in cart.');
    //             redirect('sale');
    //         }

    //         $this->db->insert('t_cart', $data);
    //         if ($this->db->affected_rows() > 0) {
    //             $this->session->set_flashdata('success', 'Item added to cart.');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to add item to cart.');
    //         }
    //     } elseif ($this->input->post('delete_cart')) {
    //         $cart_id = $this->input->post('cart_id');
    //         if ($cart_id) {
    //             $this->db->delete('t_cart', ['cart_id' => $cart_id]);
    //             if ($this->db->affected_rows() > 0) {
    //                 $this->session->set_flashdata('success', 'Item removed from cart.');
    //             } else {
    //                 $this->session->set_flashdata('error', 'Failed to remove item from cart.');
    //             }
    //         }
    //     } elseif ($this->input->post('process_payment')) {
    //         $sale = [
    //             'invoice' => $this->Sale_m->invoice_no(),
    //             'customer_id' => $this->input->post('customer_id') ?: null,
    //             'total_price' => $this->input->post('sub_total'),
    //             'discount' => $this->input->post('discount'),
    //             'final_price' => $this->input->post('grand_total'),
    //             'cash' => $this->input->post('cash'),
    //             'remaining' => $this->input->post('change'),
    //             'note' => $this->input->post('note'),
    //             'date' => date('Y-m-d H:i:s'),
    //             'user_id' => $this->fungsi->user_login()->user_id
    //         ];

    //         $this->db->insert('t_sale', $sale);
    //         if ($this->db->affected_rows() > 0) {
    //             $sale_id = $this->db->insert_id();
    //         } else {
    //             log_message('error', 'Failed to insert sale record');
    //             // Kirim pesan error ke frontend
    //         }
            
    //         if ($this->db->affected_rows() > 0) {
    //             $sale_id = $this->db->insert_id();
    //             $cart = $this->db->get('t_cart')->result();
    //             foreach ($cart as $c) {
    //                 $detail = [
    //                     'sale_id' => $sale_id,
    //                     'item_id' => $c->item_id,
    //                     'price' => $c->price,
    //                     'qty' => $c->qty,
    //                     'discount_item' => $c->discount,
    //                     'total' => $c->total
    //                 ];
    //                 $this->db->insert('t_sale_detail', $detail);

    //                 // Update stok barang
    //                 $this->db->set('stock', 'stock - ' . $c->qty, FALSE);
    //                 $this->db->where('item_id', $c->item_id);
    //                 $this->db->update('p_item');
    //             }

    //             $this->db->empty_table('t_cart');
    //             $this->session->set_flashdata('success', 'Payment processed successfully.');
    //         } else {
    //             $this->session->set_flashdata('error', 'Failed to process payment.');
    //         }
    //     }
    //     redirect('sale');
    // }

    
    public function process() {
        if ($this->input->post('process_payment')) {
            $this->db->trans_start();  // Mulai transaksi database
    
            $sale = [
                'invoice' => $this->Sale_m->invoice_no(),
                'customer_id' => $this->input->post('customer_id') ?: null,
                'total_price' => $this->input->post('sub_total'),
                'discount' => $this->input->post('discount'),
                'final_price' => $this->input->post('grand_total'),
                'cash' => $this->input->post('cash'),
                'remaining' => $this->input->post('change'),
                'note' => $this->input->post('note'),
                'date' => date('Y-m-d H:i:s'),
                'user_id' => $this->fungsi->user_login()->user_id
            ];
    
            $this->db->insert('t_sale', $sale);
            $sale_id = $this->db->insert_id();
    
            if (!$sale_id) {
                $this->session->set_flashdata('error', 'Gagal menyimpan transaksi.');
                redirect('sale');
            }
    
            $cart = $this->db->get('t_cart')->result();
            foreach ($cart as $c) {
                // Pengecekan stok sebelum insert
                $item = $this->db->get_where('p_item', ['item_id' => $c->item_id])->row();
                if ($item->stock < $c->qty) {
                    $this->session->set_flashdata('error', 'Stok tidak mencukupi untuk ' . $item->name);
                    $this->db->trans_rollback();  // Rollback transaksi jika stok kurang
                    redirect('sale');
                }
    
                $detail = [
                    'sale_id' => $sale_id,
                    'item_id' => $c->item_id,
                    'price' => $c->price,
                    'qty' => $c->qty,
                    'discount_item' => $c->discount,
                    'total' => $c->total
                ];
                $this->db->insert('t_sale_detail', $detail);
    
                // Update stok barang
                $this->db->set('stock', 'stock - ' . $c->qty, FALSE);
                $this->db->where('item_id', $c->item_id);
                $this->db->update('p_item');
            }
    
            $this->db->empty_table('t_cart');
            $this->db->trans_complete();  // Selesaikan transaksi
    
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Gagal memproses pembayaran.');
            } else {
                $this->session->set_flashdata('success', 'Pembayaran berhasil diproses.');
            }
            redirect('sale');
        }
    }
    

    
    // Fungsi untuk mendapatkan counter cart_id dan menambahkannya
function generate_cart_id() {
    // Ambil nilai counter terakhir
    $query = $this->db->get('cart_counter');
    $counter = $query->row();

    // Jika belum ada counter, set ke 1
    if (!$counter) {
        $this->db->insert('cart_counter', ['id' => 1, 'current_counter' => 1]);
        return 1;
    }

    // Increment nilai counter dan update
    $new_counter = $counter->current_counter + 1;
    $this->db->update('cart_counter', ['current_counter' => $new_counter], ['id' => 1]);

    return $new_counter;
}




    public function cart_data() {
        $data['cart'] = $this->db->get('t_cart')->result();
        $this->load->view('transaction/cart_data', $data);
    }

    public function cart_delete($cart_id) {
        if ($cart_id) {
            $this->db->delete('t_cart', ['cart_id' => $cart_id]);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Item deleted.');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete item.');
            }
        }
        redirect('sale');
    }

    public function save_cart() {
        // Logic to save item in cart
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        $item_id = $this->input->post('item_id');
        $price = $this->input->post('price');
        $qty = $this->input->post('qty');
        $discount = $this->input->post('discount');
        $total = $this->input->post('total');

        if (empty($item_id) || empty($price) || empty($qty)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
            return;
        }

        // Cek apakah item sudah ada dalam cart
        $existing_cart = $this->db->get_where('t_cart', ['item_id' => $item_id])->row();
        if ($existing_cart) {
            echo json_encode(['status' => 'error', 'message' => 'Item already in cart']);
            return;
        }

        $data = [
            'item_id' => $item_id,
            'price' => $price,
            'qty' => $qty,
            'discount' => $discount,
            'total' => $total
        ];

        // Simpan ke database
        if ($this->db->insert('t_cart', $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Item added to cart']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add item to cart']);
        }
    }

    public function load_cart() {
        // Load the current cart items
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        $data = $this->Sale_m->get_cart_by_user($user_id); // Panggil fungsi model yang difilter user_id

        $cart = $this->Sale_m->get_cart()->result();
        $response = [];
        foreach ($cart as $index => $item) {
            $response[] = [
                'no' => $index + 1,
                'barcode' => $item->barcode,
                'product_name' => $item->product_name,
                'price' => $item->price,
                'qty' => $item->qty,
                'discount' => $item->discount,
                'total' => $item->total,
                'cart_id' => $item->cart_id
            ];
        }
        echo json_encode($response);
    }

    public function remove_cart() {
        // Logic to remove item from cart
        $user_id = $this->session->userdata('user_id'); // Ambil user ID dari session
        $cart_id = $this->input->post('cart_id');
        $this->db->delete('t_cart', ['cart_id' => $cart_id]);
        $response = ['status' => 'success', 'message' => 'Item removed from cart'];
        echo json_encode($response);
    }

    public function get_cart() {
        $this->db->select('t_cart.*, p_item.barcode, p_item.name as product_name');
        $this->db->from('t_cart');
        $this->db->join('p_item', 'p_item.item_id = t_cart.item_id');
        $query = $this->db->get();
        $data['cart'] = $query->result();

        // Send data as JSON
        echo json_encode($data);
    }



    // Fungsi untuk menyimpan transaksi
    public function save_sale() {
    // Ambil data yang dikirimkan dari frontend
    $invoice = $this->input->post('invoice');
    $date = $this->input->post('date');
    $cashier = $this->input->post('cashier');
    $customer_id = $this->input->post('customer');
    $sub_total = $this->input->post('sub_total');
    $discount = $this->input->post('discount');
    $grand_total = $this->input->post('grand_total');
    $cash = $this->input->post('cash');
    $change = $this->input->post('change');
    $note = $this->input->post('note');

    // Ambil data items dalam bentuk array langsung dari POST
    $items = $this->input->post('items');  // Tidak perlu decode JSON
   // $items = json_decode($this->input->post('items'), true);
    log_message('debug', 'Items POST: ' . print_r($items, true));
   // log_message('debug', 'Decoded items: ' . print_r($items, true));
   log_message('debug', 'Raw POST Data: ' . print_r($this->input->post(), true));



    // Jika items kosong, kirimkan pesan error
    if (empty($items)) {
        echo json_encode(['status' => 'error', 'message' => 'Cart kosong']);
        return;
    }

    // Simpan data transaksi ke tabel t_sale
    $sale_data = [
        'invoice' => $invoice,
        'customer_id' => $customer_id,
        'total_price' => $sub_total,
        'discount' => $discount,
        'dinal_price' => $grand_total,
        'cash' => $cash,
        'remaining' => $change,
        'note' => $note,
        'date' => $date,
        'user_id' => $cashier,
        'created' => date('Y-m-d H:i:s')
    ];

    $this->db->insert('t_sale', $sale_data);
    $sale_id = $this->db->insert_id();  // Ambil ID transaksi yang baru saja dimasukkan

    // Simpan detail transaksi ke tabel t_sale_detail
    foreach ($items as $item) {
        $sale_detail_data = [
            'sale_id' => $sale_id,
            'item_id' => $item['item_id'],
            'price' => $item['price'],
            'qty' => $item['qty'],
            'discount' => $item['discount'],
            'total' => $item['total']
        ];
        $this->db->insert('t_sale_detail', $sale_detail_data);
    }

    // Kirimkan respon kembali ke frontend
    echo json_encode(['status' => 'success']);
}

public function clear_cart() {
    // Panggil fungsi di model untuk menghapus data cart
    $result = $this->Sale_m->delete_cart();

    // Berikan response JSON ke frontend
    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Cart telah dibersihkan.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus cart.']);
    }
}


    
    
}


<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_m extends CI_Model {

    // public function get_sales_history() {
    //     // Query untuk mengambil data penjualan dari tabel 't_sale'
    //     $this->db->select('invoice, date, customer_id, total_price, discount, dinal_price, cash, remaining, note, user_id');
    //     $this->db->from('t_sale');
    //     $this->db->order_by('date', 'DESC');  // Menampilkan data terbaru dulu
        
    //     $query = $this->db->get();

    //     // Cek jika query gagal
    //     if ($query === false) {
    //         // Log error jika query gagal
    //         log_message('error', 'Error querying the database: ' . $this->db->last_query());
    //         return [];  // Kembalikan array kosong jika query gagal
    //     }

    //     // Log query yang dijalankan untuk debugging
    //     log_message('debug', 'Last Query: ' . $this->db->last_query());

    //     // Kembalikan hasil query dalam bentuk array
    //     return $query->result_array();
    // }

    public function get_sales()
    {
        $query = $this->db->get('t_sale');  // Asumsikan tabel penjualan Anda bernama 'sales'
        return $query->result_array();  // Mengembalikan hasil sebagai array
    }

    public function delete_sale($sale_id)
    {
        // Menghapus data penjualan berdasarkan ID
        $this->db->where('sale_id', $sale_id);
        return $this->db->delete('t_sale'); // Asumsikan nama tabel penjualan adalah 'sales'
    }
}


<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    // public function __construct() {
    //     parent::__construct();
    //     // Load model untuk mengambil data penjualan
    //     $this->load->model('Reports_m');
    // }

    // public function index() {
    //     // Ambil histori penjualan dari database
    //     $sales = $this->Reports_m->get_sales_history();
    //     $this->template->load('template', 'reports/sales_reports');

    //     // Kirim data ke view
    //     $data['sales'] = $sales;
    //     $this->load->view('reports/sales_reports', $data);
    // }
    
    public function index() {
        // Ambil data penjualan dari database
        $this->load->model('Reports_m');
        $data['sales'] = $this->Reports_m->get_sales(); // Asumsikan get_sales() mengembalikan array data penjualan
    
        // Meneruskan data ke view
        $this->template->load('template', 'reports/sales_reports', $data);
    }
    
    public function delete_sale($sale_id)
    {
        // Memuat model Reports_m
        $this->load->model('Reports_m');
        
        // Menghapus data penjualan berdasarkan sale_id
        if ($this->Reports_m->delete_sale($sale_id)) {
            // Jika berhasil, tampilkan pesan sukses dan redirect ke laporan penjualan
            $this->session->set_flashdata('success', 'Sale deleted successfully.');
        } else {
            // Jika gagal, tampilkan pesan error
            $this->session->set_flashdata('error', 'Failed to delete sale.');
        }
        
        // Redirect kembali ke halaman laporan penjualan
        redirect('reports/index');
    }
    


}
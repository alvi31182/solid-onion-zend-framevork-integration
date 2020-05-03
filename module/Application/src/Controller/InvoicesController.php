<?php


namespace Application\Controller;

use App\Domain\Repository\InvoiceRepositoryInterface;
use Laminas\Mvc\Controller\AbstractActionController;

class InvoicesController extends AbstractActionController
{
    public InvoiceRepositoryInterface $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function indexAction()
    {
        $invoice = $this->invoiceRepository->getAll();

        return [
            'invoices' => $invoice
        ];
    }
}
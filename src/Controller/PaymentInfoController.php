<?php

namespace App\Controller;

use App\Entity\PaymentInfo;
use App\Form\PaymentInfoType;
use App\Repository\PaymentInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payment/info')]
class PaymentInfoController extends AbstractController
{
    #[Route('/', name: 'app_payment_info_index', methods: ['GET'])]
    public function index(PaymentInfoRepository $paymentInfoRepository): Response
    {
        return $this->render('payment_info/index.html.twig', [
            'payment_infos' => $paymentInfoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_payment_info_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PaymentInfoRepository $paymentInfoRepository): Response
    {
        $paymentInfo = new PaymentInfo();
        $form = $this->createForm(PaymentInfoType::class, $paymentInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paymentInfoRepository->add($paymentInfo, true);

            return $this->redirectToRoute('app_payment_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('payment_info/new.html.twig', [
            'payment_info' => $paymentInfo,
            'form' => $form,
        ]);
    }

    #[Route('/{licensePlate}', name: 'app_payment_info_show', methods: ['GET'])]
    public function show(PaymentInfo $paymentInfo): Response
    {
        return $this->render('payment_info/show.html.twig', [
            'payment_info' => $paymentInfo,
        ]);
    }

    #[Route('/{licensePlate}/edit', name: 'app_payment_info_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PaymentInfo $paymentInfo, PaymentInfoRepository $paymentInfoRepository): Response
    {
        $form = $this->createForm(PaymentInfoType::class, $paymentInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paymentInfoRepository->add($paymentInfo, true);

            return $this->redirectToRoute('app_payment_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('payment_info/edit.html.twig', [
            'payment_info' => $paymentInfo,
            'form' => $form,
        ]);
    }

    #[Route('/{licensePlate}', name: 'app_payment_info_delete', methods: ['POST'])]
    public function delete(Request $request, PaymentInfo $paymentInfo, PaymentInfoRepository $paymentInfoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paymentInfo->getLicensePlate(), $request->request->get('_token'))) {
            $paymentInfoRepository->remove($paymentInfo, true);
        }

        return $this->redirectToRoute('app_payment_info_index', [], Response::HTTP_SEE_OTHER);
    }
}

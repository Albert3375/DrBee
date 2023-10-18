<?php

namespace App\Http\Controllers;

// use App\Models\Estafeta;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use SoapClient;
use StdClass;
use SoapFault;

class EstafetaController extends Controller
{
    public function index()
    {
        $estafetas = Estafeta::latest()->get();
        return view('admin.estafeta.index', compact('estafetas'));
    }

    public function create()
    {
        $method = 'CREATE';
        return view('admin.estafeta.create', compact('method'));
    }

    public function store(Request $request)
    {
        $estafetas = new Estafeta();
        $estafetas->destination_info_addrees1 = $request->destination_info_addrees1;
        $estafetas->destination_info_address2 = $request->destination_info_address2;
        $estafetas->destination_info_city = $request->destination_info_city;
        $estafetas->destination_info_contactName = $request->destination_info_contactName;
        $estafetas->destination_info_corporateName = $request->destination_info_corporateName;
        $estafetas->destination_info_customerNumber = '0000000'; #Modo prueba; 000000, Producción; 5796619
        $estafetas->destination_info_neighborhood = $request->destination_info_neighborhood;
        $estafetas->destination_info_phoneNumber = $request->destination_info_phoneNumber;
        $estafetas->destination_info_state = $request->destination_info_state;
        $estafetas->destination_info_valid = true;
        $estafetas->destination_info_zipCode = $request->destination_info_zipCode;
        $estafetas->destination_info_CellPhone = $request->destination_info_CellPhone;

        $estafetas->origin_info_addreess1 = 'Calle Escorpión #3887';
        $estafetas->origin_info_addreess2 = 'S/N';
        $estafetas->origin_info_city = 'Zapopan';
        $estafetas->origin_info_contactName = 'Alix Jahzeel Luna Sánchez';
        $estafetas->origin_info_corporateName = 'Zoofish';
        $estafetas->origin_info_customerNumber = '0000000'; #Modo prueba; 000000, Producción; 5796619
        $estafetas->origin_info_neighborhood = 'La Calma';
        $estafetas->origin_info_phoneNumber = '3311881984';
        $estafetas->origin_info_state = 'Jalisco';
        $estafetas->origin_info_valid = true;
        $estafetas->origin_info_zipCode = 45070;
        $estafetas->origin_info_CellPhone = '3316930836'; #Char 0-25

        $estafetas->label_request_content = 'Paquete de pestañas';
        $estafetas->label_request_deliveryToEstafetaOffice = false;
        $estafetas->label_request_destinationInfo = $request->label_request_destinationInfo;
        $estafetas->label_request_numberOfLabels = 1;
        $estafetas->label_request_officeNum = 130; #Modo prueba; 130, Produccion; 781.
        $estafetas->label_request_originInfo = $request->label_request_originInfo;
        $estafetas->label_request_parcelTypeId = 1; //Sobre=1 Paquete=4
        $estafetas->label_request_reference = $request->label_request_reference; //Sirve como referencia adicional para que Estafeta ubique mas fácilmente el domicilio destino
        $estafetas->label_request_returnDocument = false; //Retorna un documento (doble guía) de entregado
        $estafetas->label_request_serviceTypeId = $request->label_request_serviceTypeId; //68 día siguiente, 78 es terrestre, 75 metropolitano.
        $estafetas->label_request_valid = true;
        $estafetas->label_request_weight = 1;
        $estafetas->label_request_originZipCodeForRouting = $request->label_request_originZipCodeForRouting;
        $estafetas->label_request_contentDescription = 'Paquete de pestañas Zoofish'; //Descripcion del contenido del envío char (100)

        $estafetas->estafeta_label_quadrant = 1; #Int
        $estafetas->estafeta_label_valid = false; #Boolean
        $estafetas->estafeta_label_password = 'lAbeL_K_11'; #Char #Modo prueba; lAbeL_K_11, producción; xC7Yf8WRw
        $estafetas->estafeta_label_labelDescriptionListCount = 15; #Int
        $estafetas->estafeta_label_login = 'prueba1'; #String #Modo prueba; prueba1, producción; 5796619
        $estafetas->estafeta_label_customerNumber = '0000000'; #Char-7 ##Modo prueba; 0000000, Producción; 5796619
        $estafetas->estafeta_label_labelDescriptionList = $request->estafeta_label_labelDescriptionList; #Objeto
        $estafetas->estafeta_label_suscriberId = 'Y6'; #Char-2 #Modo prueba; 28, producción; Y6
        $estafetas->estafeta_label_paperType = 1; #Int-1

        $estafetas->save();

        flash('Guia guardada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function createGuide($id)
    {
        $redirect = false;

        # Busca el registro de envío
        if (!$estafeta = Estafeta::find($id)) {
            $redirect = true;
            flash('Datos de envío no encontrados')->error()->important();
        }

        # Valida que las varaibles vengan con datos
        if (empty($estafeta->destination_info_addrees1)) {
            $redirect = true;
            flash('La dirección de envío esta vacía')->warning()->important();
        }

        if (empty($estafeta->destination_info_address2)) {
            $estafeta->destination_info_address2 = '';
        }

        if (empty($estafeta->destination_info_city)) {
            $redirect = true;
            flash('La ciudad de envío esta vacía')->warning()->important();
        }

        if (empty($estafeta->destination_info_contactName)) {
            $redirect = true;
            flash('El nombre del contacto es requerido')->warning()->important();
        }

        if (empty($estafeta->destination_info_corporateName)) {
            $estafeta->destination_info_corporateName = 'Sin corporación';
        }

        if (empty($estafeta->destination_info_neighborhood)) {
            $redirect = true;
            flash('El nombre de la colonia es requerido')->warning()->important();
        }

        if (empty($estafeta->destination_info_phoneNumber)) {
            $redirect = true;
            flash('El número de teléfono es requerido')->warning()->important();
        }

        if (empty($estafeta->destination_info_state)) {
            $redirect = true;
            flash('El nombre del estado es requerido')->warning()->important();
        }

        if (empty($estafeta->destination_info_zipCode)) {
            $redirect = true;
            flash('El código postal es requerido')->warning()->important();
        }

        if (!preg_match('/^[0-9]{5}$/i', $estafeta->destination_info_zipCode)) {
            //La instruccion no se cumple
            $redirect = true;
            flash('El código postal de envío es inválido')->error()->important();
        }

        if (empty($estafeta->destination_info_CellPhone)) {
            $redirect = true;
            flash('El teléfono móvil es requerido')->warning()->important();
        }

        if (empty($estafeta->label_request_reference)) {
            $estafeta->label_request_reference = "Sin referencia";
        }

        if ($redirect) {
            return redirect('admin/estafeta');
        }

        try {

            # $client = new SoapClient('https://label.estafeta.com/EstafetaLabel20/services/EstafetaLabelWS?wsdl');
            $client = new SoapClient('https://labelqa.estafeta.com/EstafetaLabel20/services/EstafetaLabelWS?wsdl');

            $filename = "GuiaEstafeta-" . $id . "-" . date("Y") . date("m") . date("d") . ".pdf";
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');

            # Dirección de envío
            $destinationInfo = new StdClass;
            $destinationInfo->address1 = $estafeta->destination_info_addrees1;
            $destinationInfo->address2 = $estafeta->destination_info_address2;
            $destinationInfo->city = $estafeta->destination_info_city;
            $destinationInfo->contactName = $estafeta->destination_info_contactName;
            $destinationInfo->corporateName = $estafeta->destination_info_corporateName;
            $destinationInfo->customerNumber = '0000000'; #Modo prueba; 000000, Producción; 5796619
            $destinationInfo->neighborhood = $estafeta->destination_info_neighborhood;
            $destinationInfo->phoneNumber = $estafeta->destination_info_phoneNumber;
            $destinationInfo->state = $estafeta->destination_info_state;
            $destinationInfo->valid = true;
            $destinationInfo->zipCode = $estafeta->destination_info_zipCode;
            $destinationInfo->CellPhone = $estafeta->destination_info_CellPhone; #Char 0-25

            # Dirección de origen
            $originInfo = new StdClass;
            $originInfo->address1 = 'Calle Escorpión #3887';
            $originInfo->address2 = 'S/N';
            $originInfo->city = 'Zapopan';
            $originInfo->contactName = 'Alix Jahzeel Luna Sánchez';
            $originInfo->corporateName = 'Zoofish';
            $originInfo->customerNumber = '0000000'; #Modo prueba; 000000, Producción; 5796619
            $originInfo->neighborhood = 'La Calma';
            $originInfo->phoneNumber = '3311881984';
            $originInfo->state = 'Jalisco';
            $originInfo->valid = true;
            $originInfo->zipCode = 45070;
            $originInfo->CellPhone = '3316930836'; #Char 0-25

            # Tipo de documento
            $LabelDescription = new StdClass;
            //$LabelDescription -> aditionalInfo = "";
            $LabelDescription->content = 'Paquete de pestañas';
            //$LabelDescription -> costCenter = 10.0;
            $LabelDescription->deliveryToEstafetaOffice = false;
            //$LabelDescription -> destinationCountryId = 'EU'; Mexico=NULL o EU
            $LabelDescription->destinationInfo = $destinationInfo;
            $LabelDescription->numberOfLabels = 1;
            $LabelDescription->officeNum = 130; #Modo prueba; 130, Produccion; 781.
            $LabelDescription->originInfo = $originInfo;
            $LabelDescription->parcelTypeId = 1; //Sobre=1 Paquete=4
            $LabelDescription->reference = $estafeta->label_request_reference; //Sirve como referencia adicional para que Estafeta ubique mas fácilmente el domicilio destino
            $LabelDescription->returnDocument = false; //Retorna un documento (doble guía) de entregado
            $LabelDescription->serviceTypeId = 70; //$estafeta->label_request_serviceTypeId //68 día siguiente, 78 es terrestre, 75 metropolitano.
            #$LabelDescription -> serviceTypeIdDocRet = 50;
            $LabelDescription->valid = true;
            $LabelDescription->weight = 1;
            $LabelDescription->originZipCodeForRouting = $estafeta->destination_info_zipCode;
            //$LabelDescription -> effectiveDate = 10.0;
            $LabelDescription->contentDescription = 'Paquete de pestañas Zoofish'; //Descripcion del contenido del envío char (100)

            # Datos de validación
            $EstafetaLabelRequest = new StdClass;
            $EstafetaLabelRequest->quadrant = 1; #Int
            $EstafetaLabelRequest->valid = false; #Boolean
            $EstafetaLabelRequest->password = 'lAbeL_K_11'; #Char #Modo prueba; lAbeL_K_11, producción; xC7Yf8WRw
            $EstafetaLabelRequest->labelDescriptionListCount = 14; #Int
            $EstafetaLabelRequest->login = 'prueba1'; #String #Modo prueba; prueba1, producción; 5796619
            $EstafetaLabelRequest->customerNumber = '0000000'; #Char-7 ##Modo prueba; 0000000, Producción; 5796619
            $EstafetaLabelRequest->labelDescriptionList = $LabelDescription; #Objeto
            $EstafetaLabelRequest->suscriberId = '28'; #Char-2 #Modo prueba; 28, producción; Y6
            $EstafetaLabelRequest->paperType = 1; #Int-1

            $result = $client->createLabel($EstafetaLabelRequest);

            $globalResult = $result->globalResult;
            $resultCode   = $globalResult->resultCode;

            if ($resultCode == 0) {
                # Muestra y guarda guía generada
                $labelPDF = $result->labelPDF;
                print_r($labelPDF);

                $urlGuia = "FilesGuias/" . $filename;
                $pdf = fopen($urlGuia, 'w');
                fwrite($pdf, $labelPDF);
                fclose($pdf);
            } elseif ($resultCode == 2) {
                $redirect = true;
                flash('Código Postal no válido')->error()->important();
            } elseif ($resultCode == 3) {
                $redirect = true;
                flash('Se ha terminado el rango de guías disponible para el servicio solicitado.')->error()->important();
            } elseif ($resultCode == 4) {
                $redirect = true;
                flash('La cantidad de guías solicitada ha excedido el máximo permitido por solicitud.')->error()->important();
            } elseif ($resultCode == 5) {
                $redirect = true;
                flash('El código de Páis no es válido')->error()->important();
            } elseif ($resultCode == 100) {
                $redirect = true;
                flash('La autenticación ha fallado')->error()->important();
            } elseif ($resultCode == 101) {
                $redirect = true;
                flash('Se ha capturado un identificador de país invalido ')->error()->important();
            } elseif ($resultCode == 500) {
                $redirect = true;
                flash('La creación del archivo PDF Acrobat falló')->error()->important();
            } elseif ($resultCode == 600) {
                $redirect = true;
                flash('El algoritmo de digestión MD5, falló')->error()->important();
            } elseif ($resultCode == 1000) {
                $redirect = true;
                flash('La información en un campo no es válida')->error()->important();
            }

            if ($redirect) {
                return redirect('admin/estafeta');
            }

            $labelResultList =  $result->labelResultList;
            /* $resultDescription =  $labelResultList[0]->resultDescription;

			$arrayNumGuia=explode("|",$resultDescription);
			$num = $arrayNumGuia[0];
			$num2 = $arrayNumGuia[1];
		
			if ($resultCode == 0) {

            } */
        } catch (SoapFault $e) {
            echo $e->getMessage();
        }
    }

    public function edit($id)
    {
        $estafeta = Estafeta::where('id', $id)->get()->first();
        $method = 'EDIT';

        return view('admin.estafeta.edit', compact('method', 'estafeta'));
    }

    public function update(Request $request, $id)
    {
        $estafeta = Estafeta::where('id', $id)->get()->first();

        $estafeta->bank_id = $request->bank_id;
        $estafeta->holder = $request->holder;
        $estafeta->type = $request->type;
        $estafeta->references = $request->references;
        $estafeta->save();

        flash('Guia editada correctamente.')->success()->important();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Estafeta::destroy($id);

        flash('Guia eliminada correctamente.')->success()->important();

        $estafetas = Estafeta::latest()->get();

        return view('admin.estafeta.index', compact('estafetas'));
    }
}

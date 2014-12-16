<?php defined('_JEXEC') or die;

    JLoader::register('PartsModelList', JPATH_SITE . '/components/com_parts/model/list.php');
    $model = new PartsModelList;
    $mfc_list = $model->getMfcSelectList();

?>

<form class="form-inline" name="inventory-search" id="inventory-search" action="/inventory/search-our-inventory" method="get">
    <div class="form-group col-sm-4">
        <legend>Search Our Inventory:</legend>
    </div>
    <div class="form-group col-sm-3">
        <label class="sr-only" for="manufacturer">Manufacturer</label>
        <?=$mfc_list?>
        <!--<select class="chzn-select gm-select" id="mfg" name="mfc" data-placeholder="Select a Manufacturer">
            <option value=""></option>
            <option value="3COM">3COM</option>
            <option value="Allied Telesyn">Allied Telesyn</option>
            <option value="APEX">APEX</option>
            <option value="APG">APG</option>
            <option value="Arlan">Arlan</option>
            <option value="B&amp;B">B&amp;B</option>
            <option value="Checkmate">Checkmate</option>
            <option value="Cherry">Cherry</option>
            <option value="Cisco">Cisco</option>
            <option value="Compex">Compex</option>
            <option value="Condor">Condor</option>
            <option value="Conexant">Conexant</option>
            <option value="Continuum">Continuum</option>
            <option value="Creative">Creative</option>
            <option value="D-Link">D-Link</option>
            <option value="Data Logic">Data Logic</option>
            <option value="Datamax">Datamax</option>
            <option value="Dell">Dell</option>
            <option value="Digi International">Digi International</option>
            <option value="Digipos">Digipos</option>
            <option value="Dynatron">Dynatron</option>
            <option value="Dynex">Dynex</option>
            <option value="ELO">ELO</option>
            <option value="Elpac">Elpac</option>
            <option value="Eltron">Eltron</option>
            <option value="Epson">Epson</option>
            <option value="EverFlow">EverFlow</option>
            <option value="Extron">Extron</option>
            <option value="FSP Group">FSP Group</option>
            <option value="Fujitsu">Fujitsu</option>
            <option value="Gemini">Gemini</option>
            <option value="Generic">Generic</option>
            <option value="Globe Tek">Globe Tek</option>
            <option value="GVISION">GVISION</option>
            <option value="Hewlett Packard">Hewlett Packard</option>
            <option value="HHP">HHP</option>
            <option value="Hitron">Hitron</option>
            <option value="Honeywell">Honeywell</option>
            <option value="Hypercom">Hypercom</option>
            <option value="I-ONE">I-ONE</option>
            <option value="IBM">IBM</option>
            <option value="ICL">ICL</option>
            <option value="ID Innovations">ID Innovations</option>
            <option value="ID Technologies">ID Technologies</option>
            <option value="IEE">IEE</option>
            <option value="Ingenico">Ingenico</option>
            <option value="Intel">Intel</option>
            <option value="Intermec">Intermec</option>
            <option value="ITHACA">ITHACA</option>
            <option value="Javelin">Javelin</option>
            <option value="Juniper">Juniper</option>
            <option value="Linksys">Linksys</option>
            <option value="LMR">LMR</option>
            <option value="Logic Controls">Logic Controls</option>
            <option value="Lucent">Lucent</option>
            <option value="Magtek">Magtek</option>
            <option value="Maxtor">Maxtor</option>
            <option value="Metrologic">Metrologic</option>
            <option value="Micros">Micros</option>
            <option value="Microsoft">Microsoft</option>
            <option value="Mitsumi">Mitsumi</option>
            <option value="MMF">MMF</option>
            <option value="Monarch Labeling ">Monarch Labeling </option>
            <option value="Motorola/Symbol">Motorola/Symbol</option>
            <option value="NCI">NCI</option>
            <option value="NCR">NCR</option>
            <option value="Netgear">Netgear</option>
            <option value="Netopia">Netopia</option>
            <option value="Network Everywhere">Network Everywhere</option>
            <option value="OEM">OEM</option>
            <option value="OTI">OTI</option>
            <option value="Panasonic">Panasonic</option>
            <option value="Par">Par</option>
            <option value="Partech">Partech</option>
            <option value="PartnerTech">PartnerTech</option>
            <option value="Percon Falcon">Percon Falcon</option>
            <option value="Phihong">Phihong</option>
            <option value="Planar">Planar</option>
            <option value="Posiflex">Posiflex</option>
            <option value="PREH">PREH</option>
            <option value="PSA">PSA</option>
            <option value="PSC">PSC</option>
            <option value="QSRQSR">QSRQSR</option>
            <option value="Radiant">Radiant</option>
            <option value="Raritan">Raritan</option>
            <option value="Rocketport">Rocketport</option>
            <option value="Samsung">Samsung</option>
            <option value="Sceptre">Sceptre</option>
            <option value="Seagate">Seagate</option>
            <option value="Select Electronics">Select Electronics</option>
            <option value="Services Inc">Services Inc</option>
            <option value="SMC">SMC</option>
            <option value="Spectra Physics">Spectra Physics</option>
            <option value="Squirrel WS">Squirrel WS</option>
            <option value="Star">Star</option>
            <option value="Symbol">Symbol</option>
            <option value="Symbol/Motorola">Symbol/Motorola</option>
            <option value="Tatung">Tatung</option>
            <option value="TDK">TDK</option>
            <option value="Telxon">Telxon</option>
            <option value="Tidel">Tidel</option>
            <option value="Tiger">Tiger</option>
            <option value="Transition Networks">Transition Networks</option>
            <option value="TTX">TTX</option>
            <option value="Ultimate Technology">Ultimate Technology</option>
            <option value="Unicomp">Unicomp</option>
            <option value="US Robotics">US Robotics</option>
            <option value="Verifone">Verifone</option>
            <option value="Vivotech">Vivotech</option>
            <option value="Welch Allyn">Welch Allyn</option>
            <option value="Western Digital">Western Digital</option>
            <option value="Wincor Nixdorf">Wincor Nixdorf</option>
            <option value="Yagi">Yagi</option>
            <option value="Zebra">Zebra</option>
            <option value="Zoom">Zoom</option>
        </select>-->
    </div>
    <div class="form-group col-sm-3">
        <label  class="sr-only" for="part_number">Part Number</label>
        <input type="text" placeholder="Keyword or Part ID"/>
    </div>
    <div class="form-group col-sm-2">
        <button type="submit" class="btn btn-primary">search</button>
    </div>
</form>
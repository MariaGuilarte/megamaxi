    @extends('principal')
    @section('contenido')

           <template v-if="menu==0">
             <inicio></inicio>
           </template>
        

            <template v-if="menu==1">
               
                <usuario></usuario>
               
            </template>

            <template v-if="menu==2">
                <rol></rol>
            </template>

            <template v-if="menu==3">
            <usuarioinactivo></usuarioinactivo>
            </template>

            <template v-if="menu==4">
                <proveedor></proveedor>
            </template>

            <template v-if="menu==5">
               <ingreso></ingreso>
            </template>

            <template v-if="menu==6">
                <cliente></cliente>
            </template>

            <template v-if="menu==7">
                <user></user>
            </template>

            <template v-if="menu==8">
                <cliente></cliente>
            </template>

            <template v-if="menu==9">
                <venta></venta>
            </template>

            <template v-if="menu==10">
                <h1>Reporte de ventas</h1>
            </template>

            <template v-if="menu==11">
                <categoria></categoria>
            </template>

            <template v-if="menu==12">
                <producto></producto>
            </template>
            <template v-if="menu==14">
            <dashboard></dashboard>
            </template>
             <template v-if="menu==15">
            <configuracion></configuracion>
            </template>
         
        
    @endsection
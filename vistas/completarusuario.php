<div class="perfilusu">
    <main class="main_index">
        <form class="profile-container" action="index.php?u=perfil&m=completedUser" method="post" enctype="multipart/form-data">
            <h1>Perfil de usuario</h1>
            <div class="profile-picture">
                <img id="profile-image" src="public/img/user_img/<?php echo $_SESSION['imagen'];?>" alt="Mi Foto de Perfil">
                <input type="file" name="uimg" id="profile-picture-upload" accept="pubic/img/mujer.png"
                    onchange="changeProfilePicture(event)">
            </div>
            <div>
                <?php ?>
                <label for="birthdate">Fecha de Nacimiento:</label>
                <input class="campo1" type="date" id="birthdate" name="fdn">

                <label for="gender">Género:</label>
                <select id="gender" name="genero">

                    <option value="">Selecciona tu sexo</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>

                </select>
                <label for="major">Carrera:</label>
                <select id="major" name="major">

                    <option value="masculino">Selecciona tu Carrera</option>
                    <option value="Ing Sistemas">Ing Sistemas e Informarica</option>
                    <option value="Ing Electrónica">Ing Electrónica</option>
                </select>
                <label for="pregunta">Ingresa tu PIN de seguridad</label>
                <input class="campo1" type="text" name="pin">
                <button type="submit" name="perfilcompletar">Actualizar Perfil</button>
            </dig>
        </form>
    </main>
</div>
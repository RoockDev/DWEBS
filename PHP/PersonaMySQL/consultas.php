<?php

class Consultas {
    const GETBYDNI = "SELECT * FROM personas WHERE dni = ?";
    const INSERT = "INSERT INTO personas (dni,nombre,clave,tfno) VALUES(?,?,?,?)";
    const GETALL = "SELECT * FROM personas";
    const UPDATEPATCH = "UPDATE personas SET nomber = ?,tfno = ? WHERE dni = ?";
    const UPDATEALL = "UPDATE personas SET nombre= ?, clave = ?, tfno = ?";
    const DELETE = "DELETE FROM personas WHERE dni = ?";
    
}
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using CarpoolingEL;

namespace CarpoolingEL.Controllers
{
    public class Agenda_UsuariosController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();

        // GET: Agenda_Usuarios
        public ActionResult Index()
        {
            var aGENDA_USUARIOS = db.AGENDA_USUARIOS.Include(a => a.AGENDA).Include(a => a.USUARIOS);
            return View(aGENDA_USUARIOS.ToList());
        }

        // GET: Agenda_Usuarios/Details/5
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            if (aGENDA_USUARIOS == null)
            {
                return HttpNotFound();
            }
            return View(aGENDA_USUARIOS);
        }

        // GET: Agenda_Usuarios/Create
        public ActionResult Create()
        {
            ViewBag.fkAge = new SelectList(db.AGENDA, "idAge", "idAge");
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu");
            return View();
        }

        // POST: Agenda_Usuarios/Create
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "idAgeUsu,fkAge,fkUsu")] AGENDA_USUARIOS aGENDA_USUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.AGENDA_USUARIOS.Add(aGENDA_USUARIOS);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.fkAge = new SelectList(db.AGENDA, "idAge", "idAge", aGENDA_USUARIOS.fkAge);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA_USUARIOS.fkUsu);
            return View(aGENDA_USUARIOS);
        }

        // GET: Agenda_Usuarios/Edit/5
        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            if (aGENDA_USUARIOS == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkAge = new SelectList(db.AGENDA, "idAge", "idAge", aGENDA_USUARIOS.fkAge);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA_USUARIOS.fkUsu);
            return View(aGENDA_USUARIOS);
        }

        // POST: Agenda_Usuarios/Edit/5
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "idAgeUsu,fkAge,fkUsu")] AGENDA_USUARIOS aGENDA_USUARIOS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(aGENDA_USUARIOS).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.fkAge = new SelectList(db.AGENDA, "idAge", "idAge", aGENDA_USUARIOS.fkAge);
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", aGENDA_USUARIOS.fkUsu);
            return View(aGENDA_USUARIOS);
        }

        // GET: Agenda_Usuarios/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            if (aGENDA_USUARIOS == null)
            {
                return HttpNotFound();
            }
            return View(aGENDA_USUARIOS);
        }

        // POST: Agenda_Usuarios/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            AGENDA_USUARIOS aGENDA_USUARIOS = db.AGENDA_USUARIOS.Find(id);
            db.AGENDA_USUARIOS.Remove(aGENDA_USUARIOS);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}

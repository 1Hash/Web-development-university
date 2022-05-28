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
    public class CarrosController : Controller
    {
        private CarpoolingELEntities db = new CarpoolingELEntities();
        

        // GET: Carros
        public ActionResult Index()
        {
            int v = Convert.ToInt32(Session["UserID"]);
            var cARROS = db.CARROS.Where(c => c.fkUsu == v);
            return View(cARROS.ToList());
        }

        // GET: Carros/Details/5
        public ActionResult Detalhes(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            CARROS cARROS = db.CARROS.Find(id);
            if (cARROS == null)
            {
                return HttpNotFound();
            }
            return View(cARROS);
        }

        // GET: Carros/Create
        public ActionResult Create()
        {
            //ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu");
            return View();
        }

        // POST: Carros/Create
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "idCar,modeloCar,placaCar,corCar,capacidadeCar,fkUsu")] CARROS cARROS)
        {
            if (ModelState.IsValid)
            {
                db.CARROS.Add(cARROS);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", cARROS.fkUsu);
            return View(cARROS);
        }

        // GET: Carros/Edit/5
        
        public ActionResult Editar(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            CARROS cARROS = db.CARROS.Find(id);
            if (cARROS == null)
            {
                return HttpNotFound();
            }
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", cARROS.fkUsu);
            return View(cARROS);
        }

        // POST: Carros/Edit/5
        // Para se proteger de mais ataques, ative as propriedades específicas a que você quer se conectar. Para 
        // obter mais detalhes, consulte https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Editar([Bind(Include = "idCar,modeloCar,placaCar,corCar,capacidadeCar,fkUsu")] CARROS cARROS)
        {
            if (ModelState.IsValid)
            {
                db.Entry(cARROS).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.fkUsu = new SelectList(db.USUARIOS, "idUsu", "nomeUsu", cARROS.fkUsu);
            return View(cARROS);
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

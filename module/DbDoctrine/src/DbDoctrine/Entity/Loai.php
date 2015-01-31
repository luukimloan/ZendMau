<?php

	namespace DbDoctrine\Entity;
	
	use Doctrine\ORM\Mapping as ORM;
	/*use ZfcUser\Entity\UserInterface;
	use BjyAuthorize\Provider\Role\ProviderInterface;*/
	use Doctrine\Common\Collections\ArrayCollection;


	/**
	* @ORM\Entity
	* @ORM\Table(name="loai")
	*/
	class Loai {
		
		/**
		* @ORM\Column(name="id_loai",type="integer")
		* @ORM\Id
		* @ORM\GeneratedValue
		*/
		private $idLoai;


		/**
		* @ORM\Column(name="ten_loai")
		*/
		private $tenLoai;

		public function setIdLoai($idLoai)
		{
			$this->idLoai=$idLoai;
		}
		public function getIdLoai()
		{
			return $this->idLoai;
		}

		public function setTenLoai($tenLoai)
		{
			$this->tenLoai=$tenLoai;
		}
		public function getTenLoai()
		{
			return $this->tenLoai;
		}
	}
?>
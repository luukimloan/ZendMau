<?php
	namespace DbDoctrine\Entity;
	
	use Doctrine\ORM\Mapping as ORM;
	/*use ZfcUser\Entity\UserInterface;
	use BjyAuthorize\Provider\Role\ProviderInterface;*/
	use Doctrine\Common\Collections\ArrayCollection;


	/**
	* @ORM\Entity
	* @ORM\Table(name="san_pham")
	*/
	class SanPham {
		
		/**
		* @ORM\Column(name="id_san_pham",type="integer")
		* @ORM\Id
		* @ORM\GeneratedValue
		*/
		private $idSanPham;

		/**
		* @ORM\Column(name="ten_san_pham")
		*/
		private $tenSanPham;

		/**
		* @ORM\ManyToOne(targetEntity="DbDoctrine\Entity\DonViTinh")
		* @ORM\JoinColumn(name="id_don_vi_tinh", referencedColumnName="id_don_vi_tinh")
		*/
		private $idDonViTinh;


		/**
		* @ORM\ManyToOne(targetEntity="DbDoctrine\Entity\Loai")
		* @ORM\JoinColumn(name="id_loai", referencedColumnName="id_loai")
		*/
		private $idLoai;


		public function setIdSanPham($idSanPham)
		{
			$this->idSanPham=$idSanPham;
		}
		public function getIdSanPham()
		{
			return $this->idSanPham;
		}


		public function setTenSanPham($tenSanPham)
		{
			$this->tenSanPham=$tenSanPham;
		}
		public function getTenSanPham()
		{
			return $this->tenSanPham;
		}

		public function setIdDonViTinh($idDonViTinh)
		{
			$this->idDonViTinh=$idDonViTinh;
		}
		public function getIdDonViTinh()
		{
			return $this->idDonViTinh;
		}


		public function setIdLoai($idLoai)
		{
			$this->idLoai=$idLoai;
		}
		public function getIdLoai()
		{
			return $this->idLoai;
		}
	}
?>